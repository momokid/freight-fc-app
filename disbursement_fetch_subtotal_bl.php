<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$consigneeID = mysqli_real_escape_string($dbc, $_POST['consigneeID']);
$totalAmount = floatval(mysqli_real_escape_string($dbc, $_POST['totalAmount']));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $result = [];

    $q = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname' AND HouseBL='$hbl' AND ConsigneeID='$consigneeID'");

    if (mysqli_num_rows($q) == 0) {
        $result = [
            "status_code" => 201,
            "totalExpenditureBL" => formatToCurrency(0),
            "totalExpenditure" => formatToCurrency(0),
            "hbl" => $hbl,
        ];
    } else {


        $f = totalDisbursementExpenseBL($hbl, $consigneeID);
        $g = totalDisbursementExpense($Uname);

        $cashPNL = $totalAmount - $g;

        $result = [
            'status_code' => 201,
            'totalExpenditureBL' => formatToCurrency($f),
            'totalExpenditure' => formatToCurrency($g),
            'NetPNL' => formatToCurrency($cashPNL),
            "hbl" => $hbl,
        ];
    }
}

echo json_encode($result);
