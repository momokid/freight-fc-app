<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns =  (trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$hbl =  (trim(mysqli_real_escape_string($dbc, $_POST['hbl'])));
$cns2 =  trim(mysqli_real_escape_string($dbc, $_POST['cns2']));
$wgt = floatval(trim(mysqli_real_escape_string($dbc, $_POST['wgt'])));
$pkg =  trim(mysqli_real_escape_string($dbc, $_POST['pkg']));
$unit =  trim(mysqli_real_escape_string($dbc, $_POST['unit']));
$dsc =  trim(mysqli_real_escape_string($dbc, $_POST['dsc']));
$type =  trim(mysqli_real_escape_string($dbc, $_POST['type']));
$oif =  trim(mysqli_real_escape_string($dbc, $_POST['oif']));
$vin =  trim(mysqli_real_escape_string($dbc, $_POST['vin']));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($cns == '') {
    die('Missing Cosignee ID');
} elseif ($cns2 == '') {
    die('Missing Notify Party ID');
} elseif ($hbl == '') {
    die('Missing House BL');
} elseif ($pkg == '') {
    die('Missing Package');
} elseif ($wgt == '') {
    die('Missing Weight');
} elseif ($unit == '') {
    die('Missing Unit');
} elseif ($type == '') {
    die('Select Item Type');
} elseif ($dsc == '') {
    die('Miissing Description');
} elseif ($type == 'GOODS' && $vin <> '') {
    die('VIN is only for VEHICLE Item Type');
} elseif ($type === 'VEHICLE' && $vin == '') {
    die('Enter VIN');
} elseif ($pkg > 1 && $oif == '' and $type <> 'MOTORBIKE') {
    die('Package is more than 1. You must specify Other Information');
} elseif ($pkg == 1 and $oif <> '') {
    die('Other Information not allowed for [1] Package');
} else {
    $a = mysqli_query($dbc, "select * from temp_mainbl_new_consignee where Username='$Uname'");
    if (mysqli_num_rows($a) == 0) {
        die('Select Main BL first');
    } else if (mysqli_num_rows($a) > 1) {
        die('Multiple Main BL detected');
    } else {
        $h = mysqli_query($dbc, "select * from temp_manifestation_breakdown where HouseBL='$hbl'");
        if (mysqli_num_rows($h) > 0) {
            $hn = mysqli_fetch_assoc($h);
            die('Manifest breakdown already initiated by Username: ' . $hn['Username']);
        } else {
            $z = mysqli_query($dbc, "select * from manifestation_breakdown where HouseBL='$hbl'");
            if (mysqli_num_rows($z) > 0) {
                $zn = mysqli_fetch_assoc($z);
                die('House BL# already taken');
            } else {
                $an = mysqli_fetch_assoc($a);

                $w = mysqli_query($dbc, "select * from temp_manifestation_breakdown_view where Username='$Uname' and ContainerNo='$an[ContainerNo]'");
                if (mysqli_num_rows($w) > 0) {
                    $u = mysqli_query($dbc, "select round(sum(weight),2) as TWQ from temp_manifestation_breakdown_view where Username='$Uname' and ContainerNo='$an[ContainerNo]'");

                    $un = mysqli_fetch_assoc($u);
                    $RemQty = $an['ContWeight'] - $un['TWQ'];

                    if ($wgt > $RemQty) {
                        die("Cannot add weight more than " . $RemQty);
                    }
                }

                $b = mysqli_query($dbc, "select * from temp_manifestation_breakdown where Username='$Uname' and ContainerNo='$hn[ContainerNo]'");
                if (mysqli_num_rows($b) > 0) {
                    $q = mysqli_query($dbc, "select * from temp_manifestation_breakdown where Username='$Uname' and ContainerNo<>'$hn[ContainerNo]'");


                    $w = mysqli_query($dbc, "select round(sum(Weight),3) as TW from temp_manifestation_breakdown where Username='$Uname'");
                    $wn = mysqli_fetch_assoc($w);
                    $TW = round(($an['ContWeight'] - $wn['TW']), 2);

                    if ($wgt > $TW) {
                        die('Cannot process weight more than ' . number_format($TW, 2, '.', ','));
                    } else {
                        $c = mysqli_query($dbc, "select distinct MainBL from temp_manifestation_breakdown where Username='$Uname' and ContainerNo='$hn[ContainerNo]'");
                        if (mysqli_num_rows($c) <> 1) {
                            die('Please reset manfestation breakdown process');
                        } else {
                            $cn = mysqli_fetch_assoc($c);

                            if ($cn['MainBL'] <> $an['MainBL']) {
                                die('Cannot work on multiple consigments');
                            } else {
                                $b = mysqli_query($dbc, "insert into temp_manifestation_breakdown values('$an[ConsigenmentID]','$an[MainBL]','$an[ContainerNo]','$hbl','$cns','$cns2','$dsc','$type','$vin','$oif','$wgt','$pkg','$unit','$Uname','$ajaxTime')");
                                if ($b) {
                                    echo '1';
                                } else {
                                    die($ERR);
                                }
                            }
                        }
                    }
                } else {
                    if ($wgt > $an['ContWeight']) {
                        die('Cannot process weight more than ' . number_format($TW, 2, '.', ','));
                    } else {
                        $b = mysqli_query($dbc, "insert into temp_manifestation_breakdown values('$an[ConsigenmentID]','$an[MainBL]','$an[ContainerNo]','$hbl','$cns','$cns2','$dsc','$type','$vin','$oif','$wgt','$pkg','$unit','$Uname','$ajaxTime')");
                        if ($b) {
                            echo '1';
                        } else {
                            die($ERR);
                        }
                    }
                }
            }
        }
    }
}
