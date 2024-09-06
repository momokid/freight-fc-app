<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$vehicle =  trim(mysqli_real_escape_string($dbc, $_POST['vehicle']));
$driver =  trim(mysqli_real_escape_string($dbc, $_POST['driver']));
$incident_date =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['date']))));
$incident_type_id =  (trim(mysqli_real_escape_string($dbc, $_POST['incident_type_id'])));
$location = (trim(mysqli_real_escape_string($dbc, $_POST['location'])));
$damage_estimation =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['damage_estimation'])));
$resolution_status =  trim(mysqli_real_escape_string($dbc, $_POST['resolution_status']));
$description =  trim(mysqli_real_escape_string($dbc, $_POST['description']));
$notes =  trim(mysqli_real_escape_string($dbc, $_POST['notes']));
$resolution_date =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['resolution_date']))));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($vehicle == '0' || $vehicle == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select vehice regarding the incident"
    ];
} elseif ($driver == '0' || $driver == "") {
    $res = [
        'status_code' => 301,
        'msg' => "Select driver using the vehicle during the incident",
    ];
} else if ($incident_date == '1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Select the date the incident occurred",
    ];
} else if ($incident_type_id == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select the incident type",
    ];
} else if ($location == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter the location the incident ooccured",
    ];
} else if ($description == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Give a brief description of the incident",
    ];
} else if ($damage_estimation <= 0) {
    $res = [
        'status_code' => 301,
        'msg' => "What is the damage estimation caused by the incident",
    ];
} else if ($resolution_status =='') {
    $res = [
        'status_code' => 301,
        'msg' => "What is the resolution status?",
    ];
} else if ($resolution_date== '1970-01-01') { //Drove through red light at Dzorwulu traffic
    $res = [
        'status_code' => 301,
        'msg' => "Select resolution date. Select any future date that if resolution is pending",
    ];
} else if ($notes == '0') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter notes on the incident",
    ];
}  else {

    
        $url = "https://";

        try {

            // Begin the transaction
            $pdo->beginTransaction();
            
            //Truck Trip
            $incidentData = [
                "VehicleID" => $vehicle,
                "DriverID" => $driver,
                "IncidentDate" => $incident_date,
                "IncidentTypeID" => $incident_type_id,
                "Location" => $location,
                "Description" => $description,
                "DamageEstimation" => $damage_estimation,
                "ReportURL" => $url,
                "ResolutionStatus" => $resolution_status,
                "ResolutionDate" => $resolution_date,
                "Notes" => $notes,
                "Username" => $Uname,
                "Date" => $ajaxDate,
                "Updated" => $ajaxDate,
                "Time" => $ajaxTime,
                "BranchID" => $BranchID,
            ];
            $incidentFunc = insertData($pdo, "truck_incident", $incidentData);


            // Commit the transaction
            $pdo->commit();

            $res = [
                'status_code' => 200,
                'msg' => "Vehicle incident saved successfully",
            ];

        } catch (PDOException $e) {
            $pdo->rollBack();
            $res = [
                'status_code' => 301,
                'msg' =>  $e->getMessage(),
            ];
        }
    
}
echo json_encode($res);


// If I have to run this function for multiple insert, where do I include the $pdo->beignTransaction and $pdo->commit() 