<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$brand =  trim(mysqli_real_escape_string($dbc, $_POST['brand']));
$model =  trim(mysqli_real_escape_string($dbc, $_POST['model']));
$year =  (trim(mysqli_real_escape_string($dbc, $_POST['year'])));
$account_no =  intval(trim(mysqli_real_escape_string($dbc, $_POST['account_no'])));
$cost =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['cost'])));
$amount_paid =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount_paid'])));
$accountName =  trim(mysqli_real_escape_string($dbc, $_POST['account_name']));
$license_plate =  trim(mysqli_real_escape_string($dbc, $_POST['license_plate']));
$vin =  trim(mysqli_real_escape_string($dbc, $_POST['vin']));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($brand == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Vehicle Brand"
    ];
} elseif ($model == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Vehicle Model",
    ];
} else if ($year == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Vehicle Year of Make",
    ];
} else if ($license_plate == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Vehicle License Plate",
    ];
} else if ($vin == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Vehicle VIN",
    ];
} else if ($cost < 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Cost of Vehicle",
    ];
} else if ($amount_paid < 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Amount paid cannot be less than zero(0)",
    ];
} else if ($amount_paid > $cost) {
    $res = [
        'status_code' => 301,
        'msg' => "Amount paid cannot be more than vehicle cost",
    ];
} else if ($account_no == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Credit Account",
    ];
} else {

    $a = mysqli_query($dbc, "SELECT * FROM truck_new WHERE LicensePlate = '$license_plate'");

    if (mysqli_num_rows($a) > 0) {
        $res = [
            "status_code" => 301,
            "msg" => "Vehicle with license plate $license_plate already registered"
        ];
    } else {
        $dr = "Dr";
        $cr = "Cr";
        $ncash = "Ncash";
        $status = "1";
        $auth = "N.Auth";
        $zero = 0;
        $desc = "Cost of $brand $model $year  [$license_plate] ON $ajaxTime";

        try {

            //Receipt details
            $rcpt = getReceiptDetails($ajaxDate);

            //Active accounts
            $fixed_assets_account = getActiveAccounts()['VehicleFixedAsset'];
            $payables = getActiveAccounts()['AccountPayable'];

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
            $sql = "INSERT INTO truck_new (`Brand`,`Model`,`YearOfMake`,`LicensePlate`,`VIN`,`ReceiptNo`,`Username`,`Date`,`Time`,`BranchID`,`Status`) VALUES(:brand, :model, :yearOfMake, :licensePlate, :vin, :receiptNo, :username, :date, :time, :branchId, :status)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":brand", $brand);
            $stmt->bindParam(":model", $model);
            $stmt->bindParam(":yearOfMake", $year);
            $stmt->bindParam(":licensePlate", $license_plate);
            $stmt->bindParam(":vin", $vin);
            $stmt->bindParam(":receiptNo", $rcpt['number']);
            $stmt->bindParam(":username", $Uname);
            $stmt->bindParam(":date", $ajaxDate);
            $stmt->bindParam(":time", $ajaxTime);
            $stmt->bindParam(":branchId", $BranchID);
            $stmt->bindParam(":status", $status);

            // Execute the statement
            $stmt->execute();


            //Debit fixed assets account
            $journal_debit = "INSERT INTO journal 
                            (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                            VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
            $stmt3 = $pdo->prepare($journal_debit);

            $stmt3->bindParam(":accountId", $fixed_assets_account);
            $stmt3->bindParam(":subAccountId", $fixed_assets_account);
            $stmt3->bindParam(":mode", $dr);
            $stmt3->bindParam(":ttype", $ncash);
            $stmt3->bindParam(":receipt", $rcpt['number']);
            $stmt3->bindParam(":dr", $cost);
            $stmt3->bindParam(":cr", $zero);
            $stmt3->bindParam(":description", $desc);
            $stmt3->bindParam(":date", $ajaxDate);
            $stmt3->bindParam(":time", $ajaxTime);
            $stmt3->bindParam(":username", $Uname);
            $stmt3->bindParam(":branchId", $BranchID);
            $stmt3->bindParam(":auth", $auth);
            $stmt3->bindParam(":status", $status);

            $stmt3->execute();


            //Check for amount paid
            if ($amount_paid < $cost) {
                $balance = $cost - $amount_paid;
                $desc_amt_paid = "Amount paid for $brand $model $year [$license_plate] on $ajaxTime";
                $desc_payables = "Outstanding balance for $brand $model $year [$license_plate] on $ajaxTime";

                if ($amount_paid > 0) {
                    //CREDIT AMOUNT PAID ACCOUNT
                    $journal_amount_paid = "INSERT INTO journal 
                (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
                    $stmt4 = $pdo->prepare($journal_amount_paid);

                    $stmt4->bindParam(":accountId", $account_no);
                    $stmt4->bindParam(":subAccountId", $account_no);
                    $stmt4->bindParam(":mode", $cr);
                    $stmt4->bindParam(":ttype", $ncash);
                    $stmt4->bindParam(":receipt", $rcpt['number']);
                    $stmt4->bindParam(":dr", $zero);
                    $stmt4->bindParam(":cr", $amount_paid);
                    $stmt4->bindParam(":description", $desc_amt_paid);
                    $stmt4->bindParam(":date", $ajaxDate);
                    $stmt4->bindParam(":time", $ajaxTime);
                    $stmt4->bindParam(":username", $Uname);
                    $stmt4->bindParam(":branchId", $BranchID);
                    $stmt4->bindParam(":auth", $auth);
                    $stmt4->bindParam(":status", $status);

                    $stmt4->execute();
                }


                //CREDIT PAYABLE ACCOUNT
                $journal_payable = "INSERT INTO journal 
                                (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                                VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
                $stmt5 = $pdo->prepare($journal_payable);

                $stmt5->bindParam(":accountId", $payables);
                $stmt5->bindParam(":subAccountId", $payables);
                $stmt5->bindParam(":mode", $cr);
                $stmt5->bindParam(":ttype", $ncash);
                $stmt5->bindParam(":receipt", $rcpt['number']);
                $stmt5->bindParam(":dr", $zero);
                $stmt5->bindParam(":cr", $balance);
                $stmt5->bindParam(":description", $desc_payables);
                $stmt5->bindParam(":date", $ajaxDate);
                $stmt5->bindParam(":time", $ajaxTime);
                $stmt5->bindParam(":username", $Uname);
                $stmt5->bindParam(":branchId", $BranchID);
                $stmt5->bindParam(":auth", $auth);
                $stmt5->bindParam(":status", $status);

                $stmt5->execute();
            } else {

                $desc_amt_paid = "Amount paid for $brand $model $year [$license_plate] on $ajaxTime";
                $desc_payables = "Outstanding balance for $brand $model $year [$license_plate] on $ajaxTime";

                //CREDIT AMOUNT PAID ACCOUNT
                $journal_amount_paid = "INSERT INTO journal 
                                (`AccountID`,`SubAccountID`,`Mode`,`TType`,`ReceiptNo`,`Dr`,`Cr`,`Description`,`Date`,`Time`,`Username`,`Authorizer`,`BranchID`,`Status`) 
                                VALUES(:accountId, :subAccountId, :mode, :ttype, :receipt, :dr, :cr, :description, :date, :time, :username, :auth, :branchId, :status)";
                $stmt4 = $pdo->prepare($journal_amount_paid);

                $stmt4->bindParam(":accountId", $account_no);
                $stmt4->bindParam(":subAccountId", $account_no);
                $stmt4->bindParam(":mode", $cr);
                $stmt4->bindParam(":ttype", $ncash);
                $stmt4->bindParam(":receipt", $rcpt['number']);
                $stmt4->bindParam(":dr", $zero);
                $stmt4->bindParam(":cr", $amount_paid);
                $stmt4->bindParam(":description", $desc_amt_paid);
                $stmt4->bindParam(":date", $ajaxDate);
                $stmt4->bindParam(":time", $ajaxTime);
                $stmt4->bindParam(":username", $Uname);
                $stmt4->bindParam(":branchId", $BranchID);
                $stmt4->bindParam(":auth", $auth);
                $stmt4->bindParam(":status", $status);

                $stmt4->execute();
            }

            //Check if payment is made


            // Commit the transaction
            $pdo->commit();

            $res = [
                'status_code' => 200,
                'msg' => "New vehicle registered successfully",
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
