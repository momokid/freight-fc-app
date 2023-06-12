<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$oldPass = mysqli_real_escape_string($dbc, $_POST['oldPass']);
$newPass = mysqli_real_escape_string($dbc, $_POST['newPass']);
$confirmPass = mysqli_real_escape_string($dbc, $_POST['confirmPass']);
$NP = htmlspecialchars(md5($oldPass));
$OP = htmlspecialchars(md5($oldPass));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "select * from kaina_view where ID='$Uname' and NewPass='$OP'");

    if (mysqli_num_rows($a) === 0) {
        die('Invalid password ' . $OP);
    } elseif ($newPass != $confirmPass) {
        die('Password does not match');
    } else {
        $b = mysqli_query($dbc, "update kaina set Password='$newPass' where ID='$Uname'");

        if ($b) {
            echo '1';
        } else {
            die($ERR);
        }
    }
}
