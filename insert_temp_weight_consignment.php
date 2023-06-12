<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);
$bl = mysqli_real_escape_string($dbc, $_POST['bl']);

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "select * from  consignment_weight_temp where MainBL='$bl' and Username<>'$Uname'");

    if (mysqli_num_rows($a) == 0) {
        //Query to check if the manifest breakdown
        $b = mysqli_query($dbc, "select * from manifestation_breakdown where MainBL='$bl' and ConsignmentID='$cns'");
        if (mysqli_num_rows($b) == 0) {
            die('Manifest breakdown for ' . $bl . ' not found');
        } else {
            $dbc->autocommit(FALSE);
            $c = mysqli_query($dbc, "delete from consignment_weight_temp where Username='$Uname'");
            while ($bn = mysqli_fetch_assoc($b)) {
                $d = $dbc->query("insert consignment_weight_temp values('$bn[MainBL]','$bn[HouseBL]','$bn[ConsignmentID]','$bn[Weight]','$Uname','$ajaxTime')");
            }

            //If query runs, then set commit to true
            if ($d) {
                $dbc->commit();
                echo '1';
            } else {
                die(mysqli_error($dbc));
            }
        }
    } else {
        $an = mysqli_fetch_assoc($a);
        die('Consignment weight edit already initiated by [' . $an['Username'] . ']');
    }
}
