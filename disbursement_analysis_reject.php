<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl = mysqli_real_escape_string($dbc, $_POST['bl']);
$userName = mysqli_real_escape_string($dbc, $_POST['userName']);

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else if ($bl == '') {
    $result = [
        'status_code' => 301,
        'msg' => 'Error retrieving disbursement',
    ];
} else if ($userName == '') {
    $result = [
        'status_code' => 301,
        'msg' => 'Disbursement user not found!',
    ];
} else {
    $a = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$userName'");

    if (mysqli_num_rows($a) > 0) {
        $result = [
            'status_code' => 301,
            'msg' => "User currently processing a new disbursement. Kindly contact [$userName].",
        ];
    } else {
        $b = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$bl' AND Status='2'");

        if (mysqli_num_rows($b) == 0) {
            $result = [
                'status_code' => 301,
                'msg' => "Records not found for user [$bl].",
            ];
        } else {
            while ($bn = mysqli_fetch_assoc($b)) {
                $c = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES('$bn[AccountID]','$bn[BL]','$bn[HBL]','$bn[ContainerNo]','$bn[ConsigneeID]','$bn[Expenditure]','$bn[Type]','$bn[Status]','$bn[Username]','$ajaxTime')");
            }

            if ($c) {
                $e = mysqli_query($dbc, "SELECT * FROM disbursement_analysis WHERE BL='$bl' AND Status='2'");
                while($en = mysqli_fetch_assoc($e)){
                    $d = mysqli_query($dbc, "DELETE FROM receipt_main WHERE ReceiptNo='$en[ReceiptNo]'");
                }
                

                $result = [
                    'status_code' => 301,
                    'msg' => "Records rejected successfully.",
                ];
            }
        }
    }
}


echo json_encode($result);
