<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$results = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname'");

    if (mysqli_num_rows($a) > 0) {

        $b = mysqli_query($dbc, "DELETE FROM disbursement_temp_analysis WHERE Username='$Uname'");

        if ($b) {
            $result = [
                'status_code' => 201,
                'msg' => 'Disbursement Account Reversed Successfully',
            ];
        }else{

            $result = [
                'status_code' => 503,
                'msg' => 'Disbursement Account Not Reversed',
            ];

        }
    } else {

        $result = [
            'status_code' => 503,
            'msg' => 'Disbursement Account Not Loaded',
        ];
    }


    echo  json_encode($result);
}
