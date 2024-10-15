<?php

//Abort function

use Sabberworm\CSS\Value\Value;

function abort($code = 404)
{
    $result = [
        'status_code' => 502,
        'msg' => 'ACCOUNT NOT FOUND',
    ];

    //echo $result;
    die(var_export($result));
}

//format number to accounting format
function formatToAccounting($value)
{
    return abs($value);
}

//format number to currency
function formatToCurrency($value)
{

    global $Crnc;

    return $Crnc . number_format($value, 2, '.', ',');
}

//Format number value
function formatNumber($value)
{

    //$result =  number_format(formatToAccounting($value), 2, '.', ',');

    if ($value < 0) {
        $result = formatToAccounting($value);

        return "(" . number_format(formatToAccounting($result), 2, '.', ',') . ")";
    } else {
        return number_format(formatToAccounting($value), 2, '.', ',');
    }

    //return $value;
}

//format date into Day/Month/Year
function formatDate($date, $format = "%b %d, %Y")
{
    return strftime($format, strtotime($date));
}

function totalDisbursementExpenseBL($hbl, $consigneeId)
{
    global $dbc, $Uname;

    $a = mysqli_query($dbc, "SELECT SUM(Amount) as TotalExpenseBL FROM disbursement_temp_analysis WHERE Username='$Uname' AND HouseBL='$hbl' and ConsigneeID='$consigneeId'");

    $an = mysqli_fetch_assoc($a);

    return floatval($an['TotalExpenseBL']);
}

function totalDisbursementExpense($Uname)
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) as TotalExpense, ROUND(SUM(Amount),2) as TotalAmount FROM disbursement_temp_analysis_view_1 WHERE Username='$Uname'");

    $an = mysqli_fetch_assoc($a);

    return floatval($an['TotalExpense']) + floatval($an['TotalAmount']);
}

//Disbursement table after fetching
function load_disbursement_analysis_form() {}

//Get total Disbursement Expenditure Per BL/HBL
function getExpenditureByBL($Uname)
{

    global $dbc;

    $result = [];

    $q = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname'");

    if (mysqli_num_rows($q) == 0) {
        $result = [
            "status_code" => 0,
            "totalExpenditureByBL" => 0,
            "totalExpenditure" => 0,
        ];
    } else {

        $r = mysqli_query($dbc, "SELECT SUM(Amount) as TotalExpense FROM disbursement_temp_analysis WHERE Username='$Uname'");

        $rn = mysqli_fetch_assoc($r);

        $result = [
            'status_code' => 201,
            'totalExpenditureBL' => $rn['TotalExpense'],
        ];
    }
}


//Get Receipt Number and ID

function getReceiptDetails($newDate)
{
    $result = [];

    global $dbc, $Uname;

    $Date1 = trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d', strtotime($newDate))));

    $RefDate = str_replace("-", "", $Date1);

    $a = mysqli_query($dbc, "SELECT * FROM receipt_main WHERE Username='$Uname' AND Date='$Date1'");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            'status_code' => 201,
            'msg' => 'ok',
            'Id' => 1,
            'number' => trim($_SESSION['Initial'] . $RefDate . '1'),
            'date' => $Date1
        ];
    } else {
        $b = mysqli_query($dbc, "SELECT MAX(ID) AS ID FROM receipt_main WHERE Username='$Uname' AND Date='$Date1'");

        if (mysqli_num_rows($b)) {
            $Ref = mysqli_fetch_assoc($b);
            $ID = trim($Ref['ID']) + 1;

            $result = [
                'status_code' => 201,
                'msg' => 'ok',
                'Id' => $ID,
                'number' => trim($_SESSION['Initial'] . $RefDate . $ID),
            ];
        }
    }

    return $result;
}

//Fetch disbursement authorisor
function fetchDisbursementAuthorisor()
{
    global $dbc, $Uname;

    $a = mysqli_query($dbc, "SELECT * FROM disburement_user_auth WHERE Authorisor='$Uname'");

    if (mysqli_num_rows($a) > 0) {
        return true;
    } else {
        return false;
    }
}

//
$consignment_status = [
    "pending" => "primary",
    "arrived" => "success",
    "overdue" => "danger"
];


//Set Disbursement Statue alert
function setStatusAlert($status)
{
    if ($status == 2) {
        echo "<i class='fas fa-exclamation text-warning'></i>";
    } else if ($status == 0) {
        echo "<i class='fas fa-check text-success'></i>";
    }
}


function checkDisbursementAnalysis($receiptNo)
{

    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis  WHERE ReceiptNo='$receiptNo'");

    if (mysqli_num_rows($a) > 0) {

        $an = mysqli_fetch_assoc($a);

        $res = [
            'status' => true,
            'bl' => $an['BL'],
            'consigneeID' => $an['ConsigneeID'],
        ];
    } else {

        $res = [
            'status' => false,
        ];
    }

    return $res;
}

//User auth
function userAuth($username)
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM user_auth WHERE Username ='$username'");

    if (mysqli_num_rows($a) > 0) {
        $an = mysqli_fetch_assoc($a);

        $res = [
            'status' => true,
            'auth' => $an,
        ];
    } else {
        $res = [
            'status' => false,
        ];
    }

    return $res;
}


//PDO INSERT statement
function insertData($pdo, $table, $data)
{

    // Build the SQL statement dynamically
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Execute the statement
    return $stmt->execute();
}

function getPendingConsignments()
{
    global $dbc;

    /*** 
     * Fetch all consignments that are pending. 
     * 0 means the consigment has been cleared
     * 1 means the consignment is pending disbursement
     * 2 means the consignment is pending for consignment expenses
     ***/

    $a = mysqli_query($dbc, "SELECT * FROM container_main WHERE Status <> 0");
}

function generateRandomColor()
{
    // Generate random values for R, G, and B
    $red = dechex(rand(0, 255));
    $green = dechex(rand(0, 255));
    $blue = dechex(rand(0, 255));

    // Ensure that each color component is two digits
    $red = strlen($red) == 1 ? "0" . $red : $red;
    $green = strlen($green) == 1 ? "0" . $green : $green;
    $blue = strlen($blue) == 1 ? "0" . $blue : $blue;

    return '#' . $red . $green . $blue;
}

//Get Color for ETA days
function getNotificationColor($dayCount)
{
    if (($dayCount >= 3)) {
        echo "blue";
    } else if (($dayCount < 3 && $dayCount > 0)) {
        echo "orange";
    } else if (($dayCount == 0)) {
        echo "green";
    } else if (($dayCount < 0)) {
        echo "red";
    }
}

//Get Color for ETA days
function setStatusColor($status)
{
    if (($status == "PENDING")) {
        echo "primary";
    } else if (($status == "ARRIVED")) {
        echo "success";
    } else if (($status == "OVERDUE")) {
        echo "danger";
    }
}

function isValidColorCode($color)
{
    return preg_match('/^#[0-9A-Fa-f]{6}$/', $color);
}

function getConsignmentStatusColor($bl, $containerNo, $ETA)
{

    global $dbc;

    //Check the payment on primary accounts
    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_notification WHERE BL='$bl' AND ContainerNo='$containerNo'");
    if (mysqli_num_rows($a) > 0) {

        //Get Account with the highest priority and order by Time
        $b = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_notification WHERE BL='$bl' AND ContainerNo='$containerNo' ORDER By Priority Desc");
        $bn = mysqli_fetch_assoc($b);

        echo $bn['Color'];
    } else {
        //if primary account not paid, check ETA
        getNotificationColor($ETA);
    }
}

function getGateOutExpense($bl, $containerNo)
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$bl' AND ContainerNo='$containerNo' AND Status='3'");

    if (mysqli_num_rows($a) > 0) {
        return 1;
    } else {
        return 0;
    }
}

function checkForSPlural($count)
{
    $newCount = abs($count);
    return $newCount > 1 ? 's' : '';
}


