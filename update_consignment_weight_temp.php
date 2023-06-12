<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$bl = mysqli_real_escape_string($dbc, $_POST['bl']);
$wgt = mysqli_real_escape_string($dbc, $_POST['wgt']);

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "select * from  consignment_weight_temp where MainBL='$bl' and HBL='$hbl'");

    if (mysqli_num_rows($a) == 0) {
        die('Cannot update consignment weight. Main BL/ House BL details not found');
    } else {
        $b = mysqli_query($dbc, "update consignment_weight_temp set Weight='$wgt' where MainBL='$bl' and HBL='$hbl' ");

        if ($b) {
            echo '1';
        } else {
            die($CRC);
        }
    }
}
