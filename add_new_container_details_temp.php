<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid =  intval(trim(mysqli_real_escape_string($dbc, $_POST['cid'])));
$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$cntNo =  trim(mysqli_real_escape_string($dbc, $_POST['cntNo']));
$sealNo =  trim(mysqli_real_escape_string($dbc, $_POST['sealNo']));
$cntSize =  trim(mysqli_real_escape_string($dbc, $_POST['cntSize']));
$wgt =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['wgt'])));
$cost =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['cost'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($cid == '') {
    die('Missing Congsinment ID');
} elseif ($bl == '') {
    die('Missing Bill of Laden');
} elseif ($sealNo == '') {
    die('Missing Seal No');
} elseif ($cntNo == '') {
    die('Mssing Container No.');
} elseif ($cntSize == '') {
    die('Missing Container Size');
} elseif ($wgt == '') {
    die('Missing Gross Weight');
} elseif ($cost == '' || $cost <= 0) {
    die('Enter Estimated Handling Cost');
} else {

    try {
        $a = mysqli_query($dbc, "select * from new_container_temp where Username='$Uname'");

        if (mysqli_num_rows($a) == 0) {
            $d = $dbc->prepare("insert into new_container_temp value(?,?,?,?,?,?,?,?,?)");
            $d->bind_param('sssiddsss', $bl, $sealNo, $cntNo, $cntSize, $wgt, $cost, $Uname, $ajaxDate, $ajaxTime);
            $d->execute();
            $d->close();
        } else {
            $b = mysqli_query($dbc, "select * from new_container_temp where BOL='$bl' and Username<>'$Uname'");

            if (mysqli_num_rows($b) > 0) {
                $bn = mysqli_fetch_assoc($b);
                die('Consignment registration initiiated by ' . $bn['Username']);
            } else {
                $an = mysqli_fetch_assoc($a);

                if ($bl == $an['BOL']) {
                    $d = $dbc->prepare("insert into new_container_temp value(?,?,?,?,?,?,?,?,?)");
                    ($d->bind_param('sssiddsss', $bl, $sealNo, $cntNo, $cntSize, $wgt, $cost, $Uname, $ajaxDate, $ajaxTime));
                    $d->execute();
                    $d->close();
                } else {
                    die('User has already initiated different consigment registration: BL# ' . $an['BOL']);
                }
            }
        }

        if ($d) {
            echo '1';
        } else {
            echo 'err';
        }
    } catch (PDOException $d) {
        echo $dbc->error;
    }
}
