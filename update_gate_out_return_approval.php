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

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM  container_gate_out_view WHERE BL='$bl' AND ContainerNo='$containerNo'");

    if (mysqli_num_rows($a) == 0) {
        $res = [
            "code" => 301,
            'BL'=>$bl,
            'Container'=>$containerNo,
            "msg" => "Consignment details not found"
        ];
    } else {
        /*
            update container details, container main and disbursement analysis and set status to 0
        update Returned date in container details
        
        */

        // Begin the transaction
        $dbc->autocommit(FALSE);


        $b = mysqli_query($dbc, "UPDATE container_main SET Status = 0 WHERE BL='$bl'  AND ContainerNo='$containerNo'");
        $c = mysqli_query($dbc, "UPDATE container_details SET Status = 0, ReturnedDate='$ajaxDate' WHERE BL='$bl' AND ContainerNo='$containerNo'");
        $d = mysqli_query($dbc, "UPDATE disbursement_analysis SET Status = 0 WHERE BL='$bl' AND ContainerNo='$containerNo'");

        if ($b && $c && $d) {
            $dbc->commit();

            $res = [
                'status_code' => 200,
                'msg' => "Update successfully",
            ];
        } else {
            $dbc->rollBack();
            $res = [
                'status_code' => 301,
                'msg' => 'Error updating returned container',
            ];
        }
    }
}

echo json_encode($res);
