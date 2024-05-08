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
$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));


$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($bl == '') {
    $result = [
        'status_code' => 301,
        'msg' => 'Search for BL',
    ];
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

    //get receipt number and id
    $rcpt = getReceiptDetails($dOT);

    $exisiting_rcpt_no = mysqli_query($dbc, "SELECT * FROM receipt_main WHERE ReceiptNo='$rcpt[number]'");

    if (mysqli_num_rows($exisiting_rcpt_no) > 0) {
        $result = [
            'status_code' => 501,
            'msg' => 'Receip number already exist.'.$rcpt['date'],
            'rcpt'=>$rcpt['number'],
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
            $disbursement_exist = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$bl' AND Username='$Uname'");

            if (mysqli_num_rows($disbursement_exist) > 0) {
                $result = [
                    'status_code' => 301,
                    'msg' => "Disbursement already captured for {$bl}",
                ];
            } else {



                //get default disbursement account 
                $disbursement_income_account = getDefaultDisbursementIncomeAccount();

                //get active pnl
                $activePNL = getActivePNL();

                //Get total expenditure
                $b = mysqli_query($dbc, "SELECT ROUND(SUM(Amount),2) as TotalExpenditure FROM disbursement_temp_analysis WHERE Username='$Uname'");
                $total_expenditure = mysqli_fetch_assoc($b);
                $netPNL = $amount - $total_expenditure['TotalExpenditure'];


                $dbc->autocommit(false);

                //Insert into receipt_main
                $receipt = mysqli_query($dbc, "INSERT INTO receipt_main VALUES('$rcpt[Id]','$dOT','$rcpt[number]','$Uname','$ajaxTime')");

                while ($an = mysqli_fetch_assoc($a)) {

                    //insert expenditure records into pnl_transaction
                    $pnl_dr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$an[AccountNo]','BL','Dr','$an[BL]','$an[HouseBL]','$rcpt[number]','DISBURSEMENT IFO $an[AccountNo]-$an[HouseBL]','$an[Amount]','0','$dOT','$ajaxTime','$BranchID','$Uname','2')");

                    //insert into disbursement analysis
                    $disbursement = mysqli_query($dbc, "INSERT INTO disbursement_analysis VALUE('$an[ConsigneeID]','$an[BL]','$an[HouseBL]','$an[ContainerNo]','$amount','$rcpt[number]','$an[AccountNo]','$an[Amount]','$Uname','$dOT','$ajaxTime','2','$an[Type]')");

                    //insert expenditure into journal
                    //$journal_expenditure = $dbc->query("SELECT SUM(Amount) as TotalExpenditure FROM disbursement_temp_analysis WHERE Username='$Uname'");

                }

                //insert income received into pnl
                $pnl_cr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$disbursement_income_account','NB','Cr','DISBURSEMENT RECEIPT','CASH RECEIVED','$rcpt[number]','DISBURSEMENT INCOME CASH RECEIVED','0','$netPNL','$dOT','$ajaxTime','$BranchID','$Uname','2')");

                if ($receipt and $pnl_cr and $pnl_dr and $disbursement) {

                    $delete_disbursement = mySqli_query($dbc, "DELETE FROM disbursement_temp_analysis WHERE Username='$Uname'");

                    $dbc->commit();

                    $result = [
                        'status_code' => 201,
                        //'rcp' => $rcpt['number'],
                        // 'id' => $rcpt['Id'],
                        // 'acc' => $disbursement_income_account[1],
                        'msg' => 'Disbursement analysis saved successfully',
                    ];
                } else {
                    $result = [
                        'status_code' => 301,
                        'msg' => 'Transaction not saved. Please contact your IT support.',
                    ];
                }
            }
        }
    }
}


echo json_encode($result);
