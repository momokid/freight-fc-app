<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl = mysqli_real_escape_string($dbc, $_POST['bl']);
$containerNo = mysqli_real_escape_string($dbc, $_POST['containerNo']);

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else if ($bl == '') {
    $bl = [
        'status_code' => 301,
        'msg' => 'Error retrieving disbursement - BL#',
    ];
}else if($containerNo == ""){
    $bl = [
        'status_code' => 301,
        'msg' => 'Error retrieving disbursement - ContainerNo',
    ];
} else {
    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$bl' AND ContainerNo='$containerNo'");

    if (mysqli_num_rows($a) == 0) {
        $result = [
            'status_code' => 301,
            'msg' => "Disbursement analysis not found",
        ];
    } else {
        $b = mysqli_query($dbc, "UPDATE disbursement_analysis SET Status='0' WHERE BL='$bl' AND ContainerNo='$containerNo' AND Status='2'");

        if ($b) {
            $result = [
                'status_code' => 200,
                'msg' => 'Disbursement approved successfully',
            ];
        }else{
            $result = [
                'status_code' => 301,
                'msg' => 'Error approving disbursement',
            ];
        }
    }
}

echo json_encode($result);
