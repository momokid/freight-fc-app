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
} elseif ($dOT === '' || $dOT === '1970-01-01') {
    $result = [
        'status_code' => 301,
        'msg' => 'Select Date of Transaction',
    ];
} else {

    $a = $dbc->query("SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname' AND Amount > 0");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            'status_code' => 301,
            'msg' => "No records found. Please load disbursement first."
        ];
    } else {

        //CHECK FOR EXISTING DISBURSEMENT IN THE DISBURSEMENT ANALYSIS TABLE

        
        //get receipt number and id
        $rcpt = getReceiptDetails();
        $disbursement_income_account = getDefaultDisbursementIncomeAccount();

        $dbc->autocommit(false);

        //Insert into receipt_main
        $receipt = mysqli_query($dbc, "INSERT INTO receipt_main VALUES('$rcpt[Id]','$dOT','$rcpt[number]','$Uname','$ajaxTime')");

        while ($an = mysqli_fetch_assoc($a)) {

            //insert records into pnl_transaction
            $pnl_dr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$an[AccountNo]','BL','Dr','$an[BL]','$an[HouseBL]','$rcpt[number]','DISBURSEMENT IFO $an[AccountNo]-$an[HouseBL]','$an[Amount]','0','$dOT','$ajaxTime','$BranchID','$Uname','2')");

            //insert into disbursement 
            $disbursement = mysqli_query($dbc,"INSERT INTO disbursement_analysis VALUE('$an[ConsigneeID]','$an[BL]','$an[HouseBL]','$an[ContainerNo]','$amount','$rcpt[number]','$an[AccountNo]','$an[Amount]','$Uname','$dOT','$ajaxTime','2','$an[Type]')");
            //insert into journal

            //$b = $dbc->query("SELECT * FROM ");

        }

        //insert income received
        $pnl_cr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$disbursement_income_account','NB','Cr','DISBURSEMENT RECEIPT','CASH RECEIVED','$rcpt[number]','DISBURSEMENT INCOME CASH RECEIVED','0','$amount','$dOT','$ajaxTime','$BranchID','$Uname','2')");

        if ($receipt AND $pnl_cr AND $pnl_dr AND $disbursement) {
            $dbc->commit();

            $result = [
                'status_code' => 201,
                'rcp' => $rcpt['number'],
                'id' => $rcpt['Id'],
                'acc' => $disbursement_income_account[1],
                'REASON' => 'saved',
            ];
        } else {
            $result = [
                'status_code' => 201,
                'REASON' => 'UNSAVED',
            ];
        }
    }
}


echo json_encode($result);
