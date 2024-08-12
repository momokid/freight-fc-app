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
$accountName =  trim(mysqli_real_escape_string($dbc, $_POST['accountName']));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($mbl == '' && $hbl== '') {
    $res = [
        'status_code' => 301,
        'msg' => 'BL# not found'
    ];
} elseif ($accountName == '') {
    $res = [
        'status_code' => 301,
        'msg' => "Select expense account",
    ];
} else {


   
    $a = $dbc->query("SELECT * FROM disbursement_temp_analysis where AccountNo='$accountNo' AND BL='$mbl' AND HouseBL='$hbl' AND Username='$Uname'");

    if (mysqli_num_rows($a) > 0) {
        $res = [
            'status_code' => 301,
            'msg' => "$accountName already added to disbursement"
        ];
    } else {
        $b = $dbc->query("SELECT * FROM disbursement_temp_analysis where BL='$mbl' AND HouseBL='$hbl' AND Username='$Uname'");

        $bn = mysqli_fetch_assoc($b);

        $c = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES ('$accountNo','$mbl','$hbl','$bn[ContainerNo]','$bn[ConsigneeID]',0,'$bn[Type]',3,'$Uname','$ajaxTime')");

        if ($c) {
            $res = [
                'status_code' => 200,
                'msg' => "Account added successfully"
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
