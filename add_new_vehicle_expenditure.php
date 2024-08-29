<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$exp_vehicle =  trim(mysqli_real_escape_string($dbc, $_POST['exp_vehicle']));
$vehicle_name =  trim(mysqli_real_escape_string($dbc, $_POST['vehicle_name']));
$exp_type =  trim(mysqli_real_escape_string($dbc, $_POST['exp_type']));
$exp_type_name =  trim(mysqli_real_escape_string($dbc, $_POST['exp_type_name']));
$exp_credit_account =  (trim(mysqli_real_escape_string($dbc, $_POST['exp_debit_account'])));
$exp_account =  trim(mysqli_real_escape_string($dbc, $_POST['exp_account']));
$amount =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount'])));
$description =  trim(mysqli_real_escape_string($dbc, $_POST['description']));
$vendor =  trim(mysqli_real_escape_string($dbc, $_POST['vendor']));
$tdate =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['tdate']))));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($exp_vehicle == '' || $exp_vehicle == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Vehicle for expenditure"
    ];
} elseif ($exp_type == '' || $exp_type == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Expenditure type",
    ];
} else if ($amount <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Expenditure Amount",
    ];
} else if ($exp_account == "" || $exp_account == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Select expenditure account",
    ];
} else if ($exp_credit_account == '0' || $exp_credit_account == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select debit account",
    ];
} else if ($description == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter expense description",
    ];
} else if ($vendor == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter vendor or supplier $tdate",
    ];
} else if ($tdate == '1970-01-01' || $tdate == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select transaction date",
    ];
} else {

    //Receipt details
    $rcpt = getReceiptDetails($tdate);

    $a = mysqli_query($dbc, "SELECT * FROM receipt_main WHERE ReceiptNo='$rcpt[number]'");

    if (mysqli_num_rows($a) > 0) {
        $res = [
            "status_code" => 301,
            "msg" => "Receipt number already exists."
        ];
    } else {

        $dr = "Dr";
        $cr = "Cr";
        $ncash = "Ncash";
        $status = "1";
        $auth = "N.Auth";
        $zero = 0;
        $desc = "PAYMENT IFO $exp_type_name for  $vehicle_name  [$license_plate] ON $ajaxTime";
        $desc_dr = "EXPENDITURE IFO $exp_type_name for  $vehicle_name  [$license_plate] ON $ajaxTime";
        $stamp = 'NB';


        try {

            //Active accounts
            $IE_Main = getActiveAccounts()['IE_Main'];

            // Begin the transaction
            $pdo->beginTransaction();

            //receipt main
            $receipt_main = "INSERT INTO receipt_main (`ID`,`Date`,`ReceiptNo`,`Username`,`Time`) VALUES(:Id, :date, :receiptNo, :username, :time)";
            $stmt2 = $pdo->prepare($receipt_main);

            $stmt2->bindParam(":Id", $rcpt['Id']);
            $stmt2->bindParam(":date", $ajaxDate);
            $stmt2->bindParam(":receiptNo", $rcpt['number']);
            $stmt2->bindParam(":username", $Uname);
            $stmt2->bindParam(":time", $ajaxTime);

            $stmt2->execute();


            //New truck
            $sql = "INSERT INTO truck_expense (`VehicleID`,`ExpenseTypeID`,`ReceiptNo`,`Amount`,`Vendor`,`Description`,`Username`,`Date`,`Time`,`BranchID`,`Status`) 
                    VALUES(:vehicle, :expenseType, :receiptNo, :amount, :vendor, :description, :username, :date, :time, :branchId, :status)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":vehicle", $exp_vehicle);
            $stmt->bindParam(":expenseType", $exp_type);
            $stmt->bindParam(":receiptNo", $rcpt['number']);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":vendor", $vendor);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":username", $Uname);
            $stmt->bindParam(":date", $ajaxDate);
            $stmt->bindParam(":time", $ajaxTime);
            $stmt->bindParam(":branchId", $BranchID);
            $stmt->bindParam(":status", $status);

            // Execute the statement
            $stmt->execute();


            //Debit fixed assets account
            $journal_credit = "INSERT INTO journal 
                            (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                            VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
            $stmt3 = $pdo->prepare($journal_credit);

            $stmt3->bindParam(":accountId", $exp_credit_account);
            $stmt3->bindParam(":subAccountId", $exp_credit_account);
            $stmt3->bindParam(":mode", $cr);
            $stmt3->bindParam(":ttype", $ncash);
            $stmt3->bindParam(":receipt", $rcpt['number']);
            $stmt3->bindParam(":dr", $zero);
            $stmt3->bindParam(":cr", $amount);
            $stmt3->bindParam(":description", $desc);
            $stmt3->bindParam(":date", $tdate);
            $stmt3->bindParam(":time", $ajaxTime);
            $stmt3->bindParam(":username", $Uname);
            $stmt3->bindParam(":branchId", $BranchID);
            $stmt3->bindParam(":auth", $auth);
            $stmt3->bindParam(":status", $status);

            $stmt3->execute();


            //CREDIT AMOUNT PAID ACCOUNT
            $journal_expense = "INSERT INTO journal 
                (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
            $stmt4 = $pdo->prepare($journal_expense);

            $stmt4->bindParam(":accountId", $IE_Main);
            $stmt4->bindParam(":subAccountId", $exp_account);
            $stmt4->bindParam(":mode", $dr);
            $stmt4->bindParam(":ttype", $ncash);
            $stmt4->bindParam(":receipt", $rcpt['number']);
            $stmt4->bindParam(":dr", $amount);
            $stmt4->bindParam(":cr", $zero);
            $stmt4->bindParam(":description", $desc_dr);
            $stmt4->bindParam(":date", $tdate);
            $stmt4->bindParam(":time", $ajaxTime);
            $stmt4->bindParam(":username", $Uname);
            $stmt4->bindParam(":branchId", $BranchID);
            $stmt4->bindParam(":auth", $auth);
            $stmt4->bindParam(":status", $status);

            $stmt4->execute();

             //PNL transaction
             $pnlTransactionData = [
                "AccountID" => $exp_account,
                "Stamp" => $stamp,
                "Mode" => $dr,
                "MainBL" => $exp_vehicle,
                "HouseBL" => $exp_type_name,
                "ReceiptNo" => $rcpt['number'],
                "Description" => $desc_dr,
                "Dr"=>$amount,
                "Cr"=>$zero,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "BranchID" => $BranchID,
                "Username" => $Uname,
                "Status"=>$status,
            ];
            $pnlTransactionFunc = insertData($pdo, "pnl_transaction", $pnlTransactionData);


            // Commit the transaction
            $pdo->commit();

            $res = [
                'status_code' => 200,
                'msg' => "Expenditure transaction saved successfully",
            ];
        } catch (PDOException $e) {
            $pdo->rollBack();
            $res = [
                'status_code' => 301,
                'msg' => $e->getMessage(),
            ];
        }
    }
}
echo json_encode($res);
