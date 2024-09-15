<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$trip_vehicle =  trim(mysqli_real_escape_string($dbc, $_POST['trip_vehicle']));
$trip_driver =  trim(mysqli_real_escape_string($dbc, $_POST['trip_driver']));
$pickup_address =  (trim(mysqli_real_escape_string($dbc, $_POST['pickup_address'])));
$delivery_address = (trim(mysqli_real_escape_string($dbc, $_POST['delivery_address'])));
$amount_paid =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount_paid'])));
$cargo_details =  trim(mysqli_real_escape_string($dbc, $_POST['cargo_details']));
$account_no =  trim(mysqli_real_escape_string($dbc, $_POST['account_no']));
$customer_details =  trim(mysqli_real_escape_string($dbc, $_POST['customer_details']));
$amount_charged = floatval(trim(mysqli_real_escape_string($dbc, $_POST['amount_charged'])));
$tdate =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['tdate']))));
$returnDate =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['eta']))));
$departure_time =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['departure_time']))));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($trip_vehicle == '0' || $trip_vehicle == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Vehicle for the trip"
    ];
} elseif ($trip_driver == '0' || $trip_driver == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Driver for the trip",
    ];
} else if ($pickup_address == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Pickup Address",
    ];
} else if ($delivery_address == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Delivery Address",
    ];
} else if ($departure_time == '1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Departure Date",
    ];
} else if ($returnDate == '1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Estimated Time of Arrival (ETA)",
    ];
} else if ($amount_charged <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Amount Charged for the trip",
    ];
} else if ($amount_paid <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Amount Paid",
    ];
} else if ($amount_paid != $amount_charged) {
    $res = [
        'status_code' => 301,
        'msg' => "Amount paid must be equal to Amount Charged",
    ];
} else if ($account_no == '0' || $account_no == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Debit Account",
    ];
} elseif ($cargo_details == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Details of Goods",
    ];
} elseif ($customer_details == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Customer Details",
    ];
} else if ($tdate == '1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Transaction Date ",
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
        $stamp = "NB";

        try {

            $balance = $cost - $amount_paid;
            $desc_amt_paid = "Amount paid for $cargo_details from $customer_details [$rcpt[number]] on $ajaxTime";
            $desc_revenue = "Cash revenue ifo $cargo_details from $customer_details [$rcpt[number]] on $ajaxTime";

            //Receipt details
            $rcpt = getReceiptDetails($tdate);

            //Active accounts
            $IE_Main = getActiveAccounts()['IE_Main'];
            $revenue_account = getActiveAccounts()['IncomeOnTransport'];

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

            //Truck Trip
            $tripData = [
                "VehicleID" => $trip_vehicle,
                "DriverID" => $trip_driver,
                "PickupPoint" => $pickup_address,
                "DeliveryPoint" => $delivery_address,
                "DepartureTime" => $departure_time,
                "ReturnDate" => $returnDate,
                "CustomerDetails" => $customer_details,
                "CargoDetails" => $cargo_details,
                "AmountCharged" => $amount_charged,
                "AmountPaid" => $amount_paid,
                "ReceiptNo" => $rcpt['number'],
                "Username" => $Uname,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "BranchID" => $BranchID,
                "Status" => $status,
            ];
            $tripFunc = insertData($pdo, "truck_trip", $tripData);


            //Debit Cash Account
            $journalCashData = [
                "AccountID" => $account_no,
                "SubAccountID" => $account_no,
                "Mode" => $dr,
                "TType" => $ncash,
                "ReceiptNo" => $rcpt['number'],
                "Dr" => $amount_paid,
                "Cr" => $zero,
                "Description" => $desc_amt_paid,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "Username" => $Uname,
                "BranchID" => $BranchID,
                "Status"=>$status,
            ];
            $journalCashDebitFunc = insertData($pdo, "journal", $journalCashData);

            //Debit Cash Account
            $journalRevenueData = [
                "AccountID" => $IE_Main,
                "SubAccountID" => $revenue_account,
                "Mode" => $cr,
                "TType" => $ncash,
                "ReceiptNo" => $rcpt['number'],
                "Dr" => $zero,
                "Cr" => $amount_charged,
                "Description" => $desc_revenue,
                "Date" => $tdate,
                "Time" => $ajaxTime,
                "Username" => $Uname,
                "BranchID" => $BranchID,
                "Status"=>$status,
            ];
            $journalrevenueCreditFunc = insertData($pdo, "journal", $journalRevenueData);


            //PNL transaction
            $pnlTransactionData = [
                "AccountID" => $revenue_account,
                "Stamp" => $stamp,
                "Mode" => $cr,
                "MainBL" => $trip_vehicle,
                "HouseBL" => $trip_driver,
                "ReceiptNo" => $rcpt['number'],
                "Description" => $desc_revenue,
                "Dr"=>$zero,
                "Cr"=>$amount_paid,
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
                'msg' => "Trip scheduled successfully",
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


// If I have to run this function for multiple insert, where do I include the $pdo->beignTransaction and $pdo->commit() 