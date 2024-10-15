<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$containerNo =  trim(mysqli_real_escape_string($dbc, $_POST['containerNo']));
$drAcc =  (trim(mysqli_real_escape_string($dbc, $_POST['drAcc'])));
$amount =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount'])));
$desc =  trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$crAcc =  trim(mysqli_real_escape_string($dbc, $_POST['crAcc']));
$tdate =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($bl == '0' || $bl == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Consignment Details - BL"
    ];
} elseif ($containerNo == '0' || $containerNo == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Consignment Details - Container#"
    ];
} else if ($drAcc == '' || $drAcc == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Expenditure Account",
    ];
} else if ($amount <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Expenditure Amount",
    ];
} else if ($desc == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Transaction Description",
    ];
} else if ($crAcc == '0' || $crAcc == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Cash Account",
    ];
} else if ($tdate == '1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Transaction Date ",
    ];
} else {

    $a = mysqli_query($dbc, "SELECT * FROM container_gate_out_view WHERE BL = '$bl' AND ContainerNo='$containerNo'");

    if (mysqli_num_rows($a) == 0) {
        $res = [
            "status_code" => 301,
            "msg" => "Consignment details not found"
        ];
    } else {
        $dr = "Dr";
        $cr = "Cr";
        $ncash = "Ncash";
        $status = 1;
        $auth = "N.Auth";
        $zero = 0;
        $stamp = "NB";
        $disbursementStamp = "GATE-OUT";
        $type = 'FCL';
        $disbursementStatus = 3;

        try {

            $desc_amt_paid = "Amount paid for $cargo_details from $customer_details [$rcpt[number]] on $ajaxTime";
            $desc_revenue = "Cash revenue ifo $cargo_details from $customer_details [$rcpt[number]] on $ajaxTime";

            $an = mysqli_fetch_assoc($a);
            //Receipt details
            $rcpt = getReceiptDetails($tdate);

            //Active accounts
            $IE_Main = getActiveAccounts()['IE_Main'];

            // Begin the transaction
            $pdo->beginTransaction();

            //Receipt Number
            $receiptData = [
                "ID" => $rcpt['Id'],
                "Date" => $tdate,
                "ReceiptNo" => $rcpt['number'],
                "Username" => $Uname,
                "Time" => $ajaxTime,
            ];
            $rcptFunction = insertData($pdo, "receipt_main", $receiptData);

            //PNL transaction
            $pnlTransactionData = [
                "AccountID" => $drAcc,
                "Stamp" => $stamp,
                "Mode" => $dr,
                "MainBL" => $bl,
                "HouseBL" => $containerNo,
                "ReceiptNo" => $rcpt['number'],
                "Description" => $desc,
                "Dr" => $zero,
                "Cr" => $amount,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "BranchID" => $BranchID,
                "Username" => $Uname,
                "Status" => $status,
            ];
            $pnlTransactionFunc = insertData($pdo, "pnl_transaction", $pnlTransactionData);

            //Disbursement analysis
            $disbursementAnalysisData = [
                "ConsigneeID" => $an['ConsigneeID'],
                "BL" => $bl,
                "HBL" => $bl,
                "ContainerNo" => $containerNo,
                "TotalCashReceipt" => $amount,
                "ReceiptNo" => $rcpt['number'],
                "AccountID" => $drAcc,
                "Expenditure" => $amount,
                "Stamp" => $disbursementStamp,
                "Username" => $Uname,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "Status" => $disbursementStatus,
                "BranchID" => $BranchID,
                "Type" => $type
            ];
            $disbursementAnalysisDataFunc = insertData($pdo, "disbursement_analysis", $disbursementAnalysisData);


            //Debit Cash Account
            $journalCashData = [
                "AccountID" => $crAcc,
                "SubAccountID" => $crAcc,
                "Mode" => $cr,
                "TType" => $ncash,
                "ReceiptNo" => $rcpt['number'],
                "Dr" => $zero,
                "Cr" => $amount,
                "Description" => $desc,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "Username" => $Uname,
                "BranchID" => $BranchID,
                "Status" => $status,
            ];
            $journalCashDebitFunc = insertData($pdo, "journal", $journalCashData);

            //Debit Cash Account
            $journalRevenueData = [
                "AccountID" => $IE_Main,
                "SubAccountID" => $drAcc,
                "Mode" => $dr,
                "TType" => $ncash,
                "ReceiptNo" => $rcpt['number'],
                "Dr" => $amount,
                "Cr" => $zero,
                "Description" => $desc,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "Username" => $Uname,
                "BranchID" => $BranchID,
                "Status" => $status,
            ];
            $journalrevenueCreditFunc = insertData($pdo, "journal", $journalRevenueData);


            // Commit the transaction
            $pdo->commit();

            $res = [
                'status_code' => 200,
                'msg' => "Transaction saved successfully",
            ];
        } catch (PDOException $e) {
            $pdo->rollBack();
            $res = [
                'status_code' => 301,
                'msg' => "Error: " . $e->getMessage(),
            ];
        }
    }
}

echo json_encode($res);
