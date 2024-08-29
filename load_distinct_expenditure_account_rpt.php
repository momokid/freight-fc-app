<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM pnl_transaction_balances_1 WHERE Type='EXPENDITURE' ORDER BY AccountName");

    if (mysqli_num_rows($a) == 0) {
        echo '<option id="" selected>Select Income Account</option>';
    } else {
        //  $an = mysqli_fetch_assoc($a);
        // $b = mysqli_query($dbc, "select * from sub_class_subject_view where SubClassID='$an[SubClassID]'");

        echo '<option id="" selected>Select Expenditure Account</option>';

        while ($an = mysqli_fetch_assoc($a)) {
            echo '<option id="' . $an['AccountID'] . '">' . $an['AccountName'] . '</option>';
        }
    }
}
