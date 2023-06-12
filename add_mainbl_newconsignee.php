<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns =  intval(trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$cnt =  trim(mysqli_real_escape_string($dbc, $_POST['cnt']));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($cns == '') {
    die('Missing Consignment ID');
} elseif ($bl == '') {
    die('Missing Main BL');
} elseif ($cnt == '') {
    die('Missing Container No.');
} else {
    $dbc->autocommit(FALSE);

    $a = $dbc->query("delete from rpt_multi_values_0 where Username='$Uname'");
    $b = $dbc->query("insert into rpt_multi_values_0 values('','','$cns','$bl','$cnt','$Uname','$ajaxTime')");

    if ($a and $b) {
        $dbc->commit();
        echo '1';
    } else {
        die($ERR);
    }
}
