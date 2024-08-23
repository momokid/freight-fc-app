<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$fname =  trim(mysqli_real_escape_string($dbc, $_POST['fname']));
$lname =  trim(mysqli_real_escape_string($dbc, $_POST['lname']));
$telno =  trim(mysqli_real_escape_string($dbc, $_POST['telno']));
$license =  (trim(mysqli_real_escape_string($dbc, $_POST['license'])));
$address =  (trim(mysqli_real_escape_string($dbc, $_POST['address'])));
$former_emp =  (trim(mysqli_real_escape_string($dbc, $_POST['former_emp'])));
$license =  trim(mysqli_real_escape_string($dbc, $_POST['license']));
$emp_date =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['emp_date']))));
$vehicleId =  trim(mysqli_real_escape_string($dbc, $_POST['vehicleId']));
$vehicle_name =  trim(mysqli_real_escape_string($dbc, $_POST['vehicle_name']));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($fname == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter First Name"
    ];
} elseif ($lname == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Last Name",
    ];
} else if ($license == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Driver's License #",
    ];
} else if ($address == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Driver's Adddress",
    ];
} else if ($telno == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter driver's Telephone #",
    ];
} else if ($former_emp == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Previous Experience",
    ];
} else if ($emp_date === "" || $emp_date=='1970-01-01') {
    $res = [
        'status_code' => 301,
        'msg' => "Enter Employment Date",
    ];
} else if ($vehicle_name == '' || $vehicleId=="0") {
    $res = [
        'status_code' => 301,
        'msg' => "Select Assigned Vehicle to $fname $lname",
    ];
} else {

    $a = mysqli_query($dbc, "SELECT * FROM truck_driver WHERE LicenseID = '$license'");

    if (mysqli_num_rows($a) > 0) {
        $an = mysqli_fetch_assoc($a);

        $res = [
            "status_code" => 301,
            "msg" => " $an[FirstName] $an[LastName] with license # $license already registered"
        ];
    } else {
        

        try {

            //Receipt details
            // $rcpt = getReceiptDetails($ajaxDate);

            // //Active accounts
            // $fixed_assets_account = getActiveAccounts()['VehicleFixedAsset'];
            // $payables = getActiveAccounts()['AccountPayable'];

            // Begin the transaction
            $pdo->beginTransaction();


            //New truck
            $sql = "INSERT INTO 
                    truck_driver (`VehicleAssigned`,`FirstName`,`LastName`,`LicenseID`,`PhoneNo`,`Address`,`PreviousExperience`,`EmploymentDate`,`Username`,`Date`,`Time`,`BranchID`) 
                    VALUES(:vehicleAssigned, :fname, :lname, :license, :phone, :address, :previousExperience, :empDate, :username, :date, :time, :branchId)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":vehicleAssigned", $vehicleId);
            $stmt->bindParam(":fname", $fname);
            $stmt->bindParam(":lname", $lname);
            $stmt->bindParam(":license", $license);
            $stmt->bindParam(":phone", $telno);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":previousExperience", $former_emp);
            $stmt->bindParam(":empDate", $emp_date);
            $stmt->bindParam(":username", $Uname);
            $stmt->bindParam(":date", $ajaxDate);
            $stmt->bindParam(":time", $ajaxTime);
            $stmt->bindParam(":branchId", $BranchID);

            // Execute the statement
            $stmt->execute();

            // Commit the transaction
            $pdo->commit();

            $res = [
                'status_code' => 200,
                'msg' => "New driver registered successfully",
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
