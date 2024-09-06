<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = htmlspecialchars(mysqli_real_escape_string($dbc, $_SESSION['Uname']));
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$amount =  htmlspecialchars(floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount']))));
$dOT =  htmlspecialchars(trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dOT'])))));
$bl =  htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['bl'])));
$account = htmlspecialchars(trim(mysqli_real_escape_string($dbc, $_POST['account'])));


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
} elseif ($account == '' || !$account) {
    $result = [
        'status_code' => 301,
        'msg' => 'Select Cash Revenue Source',
    ];
} elseif ($dOT === '' || $dOT === '1970-01-01') {
    $result = [
        'status_code' => 301,
        'msg' => 'Select Date of Transaction ',
    ];
} else {

    //get receipt number and id
    $rcpt = getReceiptDetails($dOT);

    $exisiting_rcpt_no = mysqli_query($dbc, "SELECT * FROM receipt_main WHERE ReceiptNo='$rcpt[number]'");

    if (mysqli_num_rows($exisiting_rcpt_no) > 0) {
        $result = [
            'status_code' => 501,
            'msg' => 'Receip number already exist.' . $rcpt['date'],
            'rcpt' => $rcpt['number'],
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
            $disbursement_exist = mysqli_query($dbc, "SELECT * FROM container_main WHERE BL='$bl' AND Status = 0");

            if (mysqli_num_rows($disbursement_exist) > 0) {
                $result = [
                    'status_code' => 301,
                    'msg' => "Consignment with BL: {$bl} already cleared.",
                ];
            } else {

                //Get Active Cashbook
                $cashbook = [
                    'status_code' => getActiveCashbook()['status'],
                    'AccountNo' => getActiveCashbook()['AccountNo'] ?? 'default_value',
                ];

                if (!$cashbook['status_code']) {
                    $result = [
                        'status_code' => $cashbook['status'],
                        'msg' => $cashbook['msg']
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
                    
      
                    //insert income received into pnl
                    //$pnl_cr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$disbursement_income_account','NB','Cr','$bl','$bl','$rcpt[number]','TOTAL CASH REVENUE RECEIVED','0','$amount','$dOT','$ajaxTime','$BranchID','$Uname','2')");



                    while ($an = mysqli_fetch_assoc($a)) {

                        //insert expenditure records into pnl_transaction
                        $pnl_dr = mysqli_query($dbc, "INSERT INTO pnl_transaction VALUES('$an[AccountNo]','BL','Dr','$an[BL]','$an[HouseBL]','$rcpt[number]','DISBURSEMENT IFO $an[AccountNo]-$an[HouseBL]','$an[Amount]','0','$dOT','$ajaxTime','$BranchID','$Uname','2')");

                        //insert into disbursement analysis
                        $disbursement = mysqli_query($dbc, "INSERT INTO disbursement_analysis VALUE('$an[ConsigneeID]','$an[BL]','$an[HouseBL]','$an[ContainerNo]','$amount','$rcpt[number]','$an[AccountNo]','$an[Amount]','$Uname','$dOT','$ajaxTime','2','$an[Type]')");

                        //insert expenditure into journal
                        $journal_dr = mysqli_query($dbc, "INSERT INTO journal VALUES('$activePNL','$an[AccountNo]','Dr','Cash','$rcpt[number]','$an[Amount]','0','EXPENDITURE PAYMENT ON - $an[HouseBL]~$an[ContainerNo]','$dOT','$ajaxTime','$Uname','N.Auth','$BranchID','1')");

                    }

                    //insert expenditure into journal
                    $journal_gl_revenue_cr = mysqli_query($dbc, "INSERT INTO journal VALUES('$account','$account','Cr','Cash','$rcpt[number]',0,'$total_expenditure[TotalExpenditure]','TOTAL CASH DISBURSEMENT EXPENDITURE - $bl','$dOT','$ajaxTime','$Uname','N.Auth','$BranchID','1')");

                    if ($receipt && $journal_dr && $disbursement && $pnl_dr && $journal_gl_revenue_cr) {

                        //
                        $update_dsibursement = mysqli_query($dbc,"UPDATE disbursement_analysis SET TotalCashReceipt='$amount' WHERE BL='$bl' AND Username='$Uname'");
                        
                        //
                        $delete_disbursement = mysqli_query($dbc, "DELETE FROM disbursement_temp_analysis WHERE Username='$Uname'");

                        $dbc->commit();

                        $result = [
                            'status_code' => 201,
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
}


echo json_encode($result);
