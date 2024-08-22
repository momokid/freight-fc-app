<?php

//Abort function
function abort($code = 404)
{
    $result = [
        'status_code' => 502,
        'msg' => 'ACCOUNT NOT FOUND',
    ];

    //echo $result;
    die(var_export($result));
}

//format number to currency
function formatToCurrency($value)
{

    global $Crnc;

    return $Crnc . number_format($value, 2, '.', ',');
}

function formatNumber($value)
{
    return number_format($value, 2, '.', ',');
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

    $a = mysqli_query($dbc, "SELECT ROUND(SUM(Amount),2) as TotalExpense FROM disbursement_temp_analysis WHERE Username='$Uname'");

    $an = mysqli_fetch_assoc($a);

    return floatval($an['TotalExpense']);
}

//Disbursement table after fetching
function load_disbursement_analysis_form()
{
}

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

//Get Color for ETA days
function getNotificationColor($dayCount)
{
    if (($dayCount >= 3)) {
        echo "primary";
    } else if (($dayCount < 3 && $dayCount > 0)) {
        echo "warning";
    } else if (($dayCount == 0)) {
        echo "success";
    } else if (($dayCount < 0)) {
        echo "danger";
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
function insertMultipleRecords($pdo, $insertData)
{
    try {
        // Begin the transaction
        $pdo->beginTransaction();

        // Loop through the insert data
        foreach ($insertData as $data) {
            // Create the SQL statement with named placeholders
            $columns = array_keys($data['columns']);
            $placeholders = array_map(function ($col) {
                return ':' . $col;
            }, $columns);

            $sql = "INSERT INTO {$data['table']} (" . implode(", ", $columns) . ") 
                    VALUES (" . implode(", ", $placeholders) . ")";

            $stmt = $pdo->prepare($sql);

            // Bind the parameters
            foreach ($data['columns'] as $column => $value) {
                $stmt->bindValue(':' . $column, $value);
            }

            // Execute the statement
            $stmt->execute();
        }

        // Commit the transaction
        $pdo->commit();

        echo $res = [
            'status_code' => 200,
            'msg' => "New vehicle registered successfully",
        ];

        echo "All records inserted successfully.";
    } catch (PDOException $e) {
        // Roll back the transaction if something failed
        $pdo->rollBack();
        echo $res = [
            'status_code' => 301,
            'msg' => $e->getMessage(),
        ];
    }
}