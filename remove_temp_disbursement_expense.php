<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$mbl =  (trim(mysqli_real_escape_string($dbc, $_POST['mbl'])));
$hbl =  trim(mysqli_real_escape_string($dbc, $_POST['hbl']));
$accountNo =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['accountNo'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($mbl == '' && $hbl== '') {
    $res = [
        'status_code' => 301,
        'msg' => 'BL# not found'
    ];
} elseif ($accountNo == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Expenditure account details not found",
    ];
} else {


   
    $a = $dbc->query("SELECT * FROM disbursement_temp_analysis WHERE AccountNo='$accountNo' AND BL='$mbl' AND HouseBL='$hbl' AND Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        $res = [
            'status_code' => 301,
            'msg' => "Disbursement expense account not found"
        ];
    } else {
       
        $c = $dbc->query("DELETE FROM disbursement_temp_analysis WHERE BL='$mbl' AND HouseBL='$hbl' AND AccountNo='$accountNo' AND Username='$Uname'");

        if ($c) {
            $res = [
                'status_code' => 200,
                'msg' => "Account remove successfully"
            ];
            
        } else {
            $res = [
                'status_code' => 301,
                'msg' => "Error Message: $ERR"
            ]; 
        }
    }
}

echo json_encode($res);
