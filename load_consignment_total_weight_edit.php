<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "select * from consignment_weight_temp where Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        die('0.00');
    } else {
        $b = mysqli_query($dbc, "select round(sum(Weight),2) as Total from consignment_weight_temp where Username='$Uname'");

        $cn = mysqli_fetch_assoc($b);

        echo $cn['Total'];
    }
}
