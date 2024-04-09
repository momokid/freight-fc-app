<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$mbl = mysqli_real_escape_string($dbc, $_POST['mbl']);
$hbl = mysqli_real_escape_string($dbc, $_POST['hbl']);
$consigneeID = mysqli_real_escape_string($dbc, $_POST['consigneeID']);

$results = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $b = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname' AND BL='$mbl' AND HouseBL='$hbl' and ConsigneeID='$consigneeID'");

    if (mysqli_num_rows($b) == 0) {

        $a = mysqli_query($dbc, "SELECT * FROM disbursement_accounts");

        if (mysqli_num_rows($a) == 0) {
            $result = [
                'status_code' => 501,
                'msg' => 'Disbursement Account Not Mapped',
            ];
        } else {

            $dbc->autocommit(false);

            while ($an = mysqli_fetch_assoc($a)) {
                $b = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES('$an[AccountNo]','$mbl','$hbl','$consigneeID','0','EXPENDITURE','FCL','$Uname','$ajaxTime')");
            }

            $c = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES('5079','$mbl','$hbl','$consigneeID','0','INCOME','FCL','$Uname','$ajaxTime')");

            if ($b && $c) {
                $dbc->commit(TRUE);

                $result = [
                    'status_code' => 201,
                    'msg' => 'Disbursement Account Loaded',
                ];
            } else {
                $result = [
                    'status_code' => 503,
                    'msg' => 'Disbursement Account Not Loaded',
                ];
            }
        }
    } else {
        $result = [
            'status_code' => 201,
            'msg' => 'Disbursement Account Loaded',
        ];
    }


    echo json_encode($result);
}
