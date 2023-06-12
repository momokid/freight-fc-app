<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e =  (trim(mysqli_real_escape_string($dbc, $_POST['e'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    if ($e == '') {
        die('Select GL Account');
    }
    $a = mysqli_query($dbc, "select * from general_ledger_balances_0 where AccountID='$e'");

    if (mysqli_num_rows($a) == 0) {
        echo '0.00';
    } else {
        //$b = mysqli_query($dbc, "select max(CarrierID) as ID from ship_carrier");

        $an = mysqli_fetch_assoc($a);

        echo $an['Balance'];
    }
}
