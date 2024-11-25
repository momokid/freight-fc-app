<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl = mysqli_real_escape_string($dbc, $_POST['bl']);
$container = mysqli_real_escape_string($dbc, $_POST['container']);

try {
    $a = mysqli_query($dbc, "SELECT * FROM container_details WHERE BL='$bl'");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            "code" => 502,
            "msg" => "Consignment details not found",
        ];
    } else {
        $b = mysqli_query($dbc,"UPDATE container_details SET Status = 3, GateOutDate='$ajaxDate' WHERE BL = '$bl'");

        if($b){
            $result = [
                "code" => 200,
                "msg" => "Consignment updated successfully"
            ];
        }else{
            $result = [
                "code" => 502,
                "msg" => "Error updating consignment"
            ];
        }
    }
} catch (Exception $e) {
    $result = [
        "code" => 502,
        "msg" => $e->getMessage(),
    ];
}



echo json_encode($result);
