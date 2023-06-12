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
    $a = mysqli_query($dbc, "select * from active_petty_cash_view_0 where Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        echo '00.00';
    } else {

        $an = mysqli_fetch_assoc($a);

        echo $an['TBal'];
    }
}
