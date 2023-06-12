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
    $a = mysqli_query($dbc, "select * from ie_transaction_journal_balance_0 where SubAccountID='$e'");

    if (mysqli_num_rows($a) == 0) {
        echo '0.00';
    } else {

        $an = mysqli_fetch_assoc($a);

        echo $an['TBal'];
    }
}
