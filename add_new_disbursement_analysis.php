<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$amount =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount'])));
$dOT =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dOT']))));

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($amount == '' || $amount <= 0) {
    $result = [
        'status_code' => 301,
        'msg' => 'Enter Cash Income Received',
    ];
} elseif ($dOT === '' || $dOT==='1970-01-01') {
    $result = [
        'status_code' => 301,
        'msg' => 'Select Date of Transaction',
    ];
} else {

    $a = $dbc->query("SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            'status_code' => 301,
            'msg' => "No records found. Please load disbursement first."
        ];
    } else {

        //get receipt number and id
         $rcpt = getReceiptDetails();
         $disbursement_income_account = getDefaultDisbursementIncomeAccount();

        $dbc->autocommit(false);

        //Insert into receipt_main
       $r = mysqli_query($dbc, "INSERT INTO receipt_main VALUES('$rcpt[Id]','','','','','')");

        //insert records into pnl_transaction
       $b = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES()");

        //insert into disbursement 

        //insert into journal

        //$b = $dbc->query("SELECT * FROM ");



        $result = [
            'status_code' => 201,
            'msg' => 'Message received',
            'rcp' => $rcpt['number'],
            'id' => $rcpt['Id'],
            'acc' => $disbursement_income_account[1],
            'dot'=>$dOT,
        ];
    }
}


echo json_encode($result);
