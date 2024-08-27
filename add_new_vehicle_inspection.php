<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$insp_vehicle =  trim(mysqli_real_escape_string($dbc, $_POST['insp_vehicle']));
$inspection_type =  trim(mysqli_real_escape_string($dbc, $_POST['inspection_type']));
$inspector_name =  (trim(mysqli_real_escape_string($dbc, $_POST['inspector_name'])));
$tire_condition = (trim(mysqli_real_escape_string($dbc, $_POST['tire_condition'])));
$odometer =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['odometer'])));
$brake_condition =  trim(mysqli_real_escape_string($dbc, $_POST['brake_condition']));
$light_condition =  trim(mysqli_real_escape_string($dbc, $_POST['light_condition']));
$engine_condition =  trim(mysqli_real_escape_string($dbc, $_POST['engine_condition']));
$fluid_level =  trim(mysqli_real_escape_string($dbc, $_POST['fluid_level']));
$additional_notes =  trim(mysqli_real_escape_string($dbc, $_POST['additional_notes']));
$body_condition = (trim(mysqli_real_escape_string($dbc, $_POST['body_condition'])));
$inspection_date =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['inspection_date']))));
$next_inspection_date =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['next_inspection_date']))));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($insp_vehicle == '0' || $insp_vehicle == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Vehicle for the inspection"
    ];
} elseif ($inspection_type == '0' || $inspection_type == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Inspection type",
    ];
} else if ($inspector_name == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Inspector's name",
    ];
} else if ($odometer == '' || $odometer <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Odometer reading",
    ];
} else if ($tire_condition == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Tire Condition",
    ];
} else if ($brake_condition == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Brake Condition",
    ];
} else if ($light_condition == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Light Condition",
    ];
} else if ($engine_condition == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select Engine Condition",
    ];
} else if ($fluid_level == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Fluid Level",
    ];
} else if ($body_condition == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Body Condition",
    ];
} elseif ($inspection_date == "1970-01-01") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Inspection Date",
    ];
} elseif ($next_inspection_date == "1970-01-01") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Next Inspection Date",
    ];
} else if ($additional_notes == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Additional Notes or Inspection Remarks",
    ];
} else if ($inspection_date >= $next_inspection_date) {
    $res = [
        'status_code' => 301,
        'msg' => "Next inspection date must be after " . formatDate($inspection_date),
    ];
} else {

    $a = mysqli_query($dbc, "SELECT * FROM truck_inspection  WHERE VehicleID  = '$insp_vehicle' AND InspectionDate='$inspection_date'");

    if (mysqli_num_rows($a) > 0) {
        $res = [
            "status_code" => 301,
            "msg" => "Vehicle already inspected on this " . formatDate($inspection_date),
        ];
    } else {

        $b = mysqli_query($dbc, "SELECT * FROM truck_inspection WHERE VehicleID='$insp_vehicle' ORDER BY Time DESC LIMIT 1");

        $bn = mysqli_fetch_assoc($b);
        if ($odometer < $bn['OdometerReading']) {
            $res = [
                "status_code" => 301,
                "msg" => "Odometer cannot be less than $bn[OdometerReading] from the last inspection",
            ];
        } else {



            try {


                // Begin the transaction
                $pdo->beginTransaction();

                //Truck Trip
                $inspectionData = [
                    "VehicleID" => $insp_vehicle,
                    "InspectionDate" => $inspection_date,
                    "InspectorName" => $inspector_name,
                    "InspectionType" => $inspection_type,
                    "OdometerReading" => $odometer,
                    "TireCondition" => $tire_condition,
                    "BrakeCondition" => $brake_condition,
                    "LightsCondition" => $light_condition,
                    "EngineCondition" => $engine_condition,
                    "FluidLevels" => $fluid_level,
                    "BodyCondition" => $body_condition,
                    "AdditionalNotes" => $additional_notes,
                    "NextInspectionDate" => $next_inspection_date,
                    "Username" => $Uname,
                    "Time" => $ajaxTime,
                    "BranchID" => $BranchID,
                ];
                $inspectionFunc = insertData($pdo, "truck_inspection", $inspectionData);


                // Commit the transaction
                $pdo->commit();

                $res = [
                    'status_code' => 200,
                    'msg' => "Vehicle Inspection details saved successfully",
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
}

echo json_encode($res);


// If I have to run this function for multiple insert, where do I include the $pdo->beignTransaction and $pdo->commit() 