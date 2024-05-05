<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$totalAmount = floatval(mysqli_real_escape_string($dbc, $_POST['amount']));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $result = [];

    $q = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname'");

    if (mysqli_num_rows($q) == 0) {
        $result = [
            "status_code" => 201,
            "NetPNL" => formatToCurrency(0),
        ];
    } else {


        $g = totalDisbursementExpense($Uname);

        $cashPNL = $totalAmount - $g;

        $result = [
            'status_code' => 201,
            'NetPNL' => formatToCurrency($cashPNL),
        ];
    }
}

echo json_encode($result);
