<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e2 = mysqli_real_escape_string($dbc, $_POST['e2']);
$e3 = mysqli_real_escape_string($dbc, $_POST['e3']);
$e1 = mysqli_real_escape_string($dbc, $_POST['e1']);
$fdt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['fdt'])));
$ldt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['ldt'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "select * from  rpt_multi_values_0 where Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        $dbc->autocommit(FALSE);
        $b = $dbc->query("insert  rpt_multi_values_0 values('$fdt','$ldt','$e1','$e2','$e3','$Uname','$ajaxTime')");

        if ($b) {
            $dbc->commit();
            echo '1';
        }
    } else {
        $dbc->autocommit(FALSE);
        $c = $dbc->query("delete from  rpt_multi_values_0 where Username='$Uname'");
        $b = $dbc->query("insert  rpt_multi_values_0 values('$fdt','$ldt','$e1','$e2','$e3','$Uname','$ajaxTime')");

        if ($c and $b) {
            $dbc->commit();
            echo '1';
        } else {
            die(mysqli_error($dbc));
        }
    }
}
