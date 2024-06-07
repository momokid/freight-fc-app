<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$receiptNo = mysqli_real_escape_string($dbc, $_POST['receiptNo']);

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else if ($receiptNo == '') {
    $receiptNo = [
        'status_code' => 301,
        'msg' => 'Error retrieving disbursement',
    ];
} else {
    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE ReceiptNo='$receiptNo'");

    if (mysqli_num_rows($a) == 0) {
        $receiptNo = [
            'status_code' => 301,
            'msg' => "Disbursement analysis not found",
        ];
    } else {
        $b = mysqli_query($dbc, "UPDATE disbursement_analysis SET Status='0' WHERE ReceiptNo='$receiptNo'");

        if ($b) {
            $result = [
                'status_code' => 200,
                'msg' => 'Disbursement approved successfully',
            ];
        }else{
            $result = [
                'status_code' => 301,
                'msg' => 'Error approving disbursement',
            ];
        }
    }
}

echo json_encode($result);
