<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$AccountNo = mysqli_real_escape_string($dbc, $_POST['accountNo']);
$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$consigneeID = mysqli_real_escape_string($dbc, $_POST['consigneeID']);
$amount = floatval(mysqli_real_escape_string($dbc, $_POST['amount']));

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else if ($amount < 0 || $amount == '') {
    $result = [
        'msg' => 'Enter a valid amount',
        'status_code' => 503,
        'amount' => $amount
    ];
} else {

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE HouseBL='$hbl' AND ConsigneeID='$consigneeID' AND AccountNo='$AccountNo'");

    if (mysqli_num_rows($a) == 1) {
        $b = mysqli_query($dbc,"UPDATE disbursement_temp_analysis SET Amount='$amount' WHERE HouseBL='$hbl' AND ConsigneeID='$consigneeID' AND AccountNo='$AccountNo'");

        if($b){
            $result = [
                'msg' => 'Amount updated successfully',
                'status_code' => 201,
            ]; 
        }else{
            $result = [
                'msg' => 'Error updating amount',
                'status_code' => 503,
                'amount' => $amount
            ];
        }
        
    } else {
        $result = [
            'msg' => 'Account records not loded',
            'status_code' => 503
        ];
    }
}



echo json_encode($result);
