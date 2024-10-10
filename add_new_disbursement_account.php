<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$accountID =  intval(trim(mysqli_real_escape_string($dbc, $_POST['accountID'])));
$priority =  (trim(mysqli_real_escape_string($dbc, $_POST['priority'])));
$color =  (trim(mysqli_real_escape_string($dbc, $_POST['color'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else if ($priority === "") {
    die('Assign account priority level');
} elseif ($color === "") {
    die('Set disbursement background notification color');
} elseif ($accountID == '') {
    die('Missing Account Name');
} else {

    $a = $dbc->query("SELECT * FROM disbursement_accounts WHERE AccountNo='$accountID'");

    if (mysqli_num_rows($a) > 0) {
        die('Account already added');
    } else {

        $b = mysqli_query($dbc, "INSERT INTO disbursement_accounts VALUES('$accountID','$priority','$color','$Uname','$ajaxTime')");
        if ($b) {
            echo '1';
        } else {
            die($ERR);
        }
    }
}
