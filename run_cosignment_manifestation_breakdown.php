<?php

//start the session
session_start();

//Database connection
include 'cn/cn.php';

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query(
        $dbc,
        "select * from temp_mainbl_new_consignee where Username='$Uname'"
    );
    $i = mysqli_query(
        $dbc,
        "select * from temp_manifestation_breakdown_total_weight_view_0 where Username='$Uname'"
    );
    $in = mysqli_fetch_assoc($i);

    if (mysqli_num_rows($a) == 0) {
        die('Select Main BL first');
    } elseif (mysqli_num_rows($a) > 1) {
        die('Multiple Main BL detected');
    } else {
        $an = mysqli_fetch_assoc($a);
        $z = mysqli_query(
            $dbc,
            "delete from rpt_multi_values where Username='$Uname'"
        );

        $b = mysqli_query(
            $dbc,
            "select * from temp_manifestation_breakdown where Username='$Uname'"
        );
        if (mysqli_num_rows($b) > 0) {
            $w = mysqli_query(
                $dbc,
                "select round(sum(Weight),2) as TW from temp_manifestation_breakdown where Username='$Uname'"
            );
            $wn = mysqli_fetch_assoc($w);
            $TW = $an['ContWeight'] - $wn['TW'];

            if ($in['BLWeight'] != $wn['TW']) {
                die(
                    'Total weight of manifest breakdown must be equal ' .
                        $an['ContWeight']
                );
            } else {
                $c = mysqli_query(
                    $dbc,
                    "select distinct MainBL from temp_manifestation_breakdown where Username='$Uname'"
                );
                if (mysqli_num_rows($c) != 1) {
                    die('Please reset manfestation breakdown process');
                } else {
                    $cn = mysqli_fetch_assoc($c);

                    if ($cn['MainBL'] != $an['MainBL']) {
                        die('Cannot work on multiple consigments');
                    } else {
                        $d = mysqli_query(
                            $dbc,
                            "select * from temp_manifestation_breakdown where Username='$Uname' and MainBL='$an[MainBL]'"
                        );


                        $dbc->autocommit(false);
                        $zz = mysqli_query(
                            $dbc,
                            "insert into rpt_multi_values values('','','$an[MainBL]','','$Uname','$ajaxTime')"
                        );

                        $r = mysqli_query($dbc,"insert into eta_web_track value('$an[ConsigenmentID]','$an[MainBL]','$an[ETA]','ON THE WAY','1','$Uname','$ajaxTime')");


                        while ($an = mysqli_fetch_assoc($d)) {
                            $b = mysqli_query(
                                $dbc,
                                "insert into manifestation_breakdown values('$an[ConsignmentID]','$an[MainBL]','$an[ContainerNo]','$an[HouseBL]','$an[CosigneeID]','$an[Cosignee2_ID]','$an[Description]','$an[ItemType]','$an[VIN]','$an[OtherInfo]','$an[Weight]','$an[Package]','$an[Unit]','$Uname','$ajaxDate','$ajaxTime','1')"
                            );
                        }
                       
                        if ($b and $z and $zz) {
                            $e = mysqli_query($dbc, "delete from temp_manifestation_breakdown where Username='$Uname'");
                            $f = mysqli_query($dbc,"delete from rpt_multi_values_0 where Username='$Uname'");
                           $dbc->commit();
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
