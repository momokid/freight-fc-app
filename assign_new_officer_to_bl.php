<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$newOfficer =  (trim(mysqli_real_escape_string($dbc, $_POST['newOfficer'])));

$result = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($newOfficer == '') {
    die('Select Officer');
}  else {
    $a = mysqli_query($dbc, "SELECT * FROM temp_mainbl_new_consignee WHERE Username='$Uname'");
    if (mysqli_num_rows($a) == 0) {
        $result = [
            'code'=>401,
            'msg'=>'Search for BL details first',
        ];
    } else if (mysqli_num_rows($a) > 1) {
        $result = [
            'code'=>401,
            'msg'=>'Multiple BLs detected',
        ];
    }else{
        $an = mysqli_fetch_assoc($a);

        $b = mysqli_query($dbc,"SELECT * FROM container_main WHERE BL='$an[MainBL]'");

        if(mysqli_num_rows($b) <> 1){
            $result = [
                "code"=>401,
                "msg"=>"BL details not found."
            ];
        }else{
            $c = mysqli_query($dbc,"UPDATE container_main SET OfficerAssigned='$newOfficer' WHERE BL='$an[MainBL]'");

            if($c){
                $d = $dbc->query("DELETE FROM rpt_multi_values_0 where Username='$Uname'");
                $result = [
                    'code'=>200,
                    'msg'=>'Officer assigned successfully'
                ];
            }else{
                $result = [
                    "code"=>401,
                    "msg"=>"Error assigning officer to BL",
                ];
            }
            
        }
    }
}


echo json_encode($result);