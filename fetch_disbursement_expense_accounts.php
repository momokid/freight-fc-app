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
$containerNo = mysqli_real_escape_string($dbc, $_POST['containerNo']);

$results = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    // $b = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname' AND BL='$mbl' AND HouseBL='$hbl' and ConsigneeID='$consigneeID'");

    $b = mysqli_query($dbc, "SELECT * FROM disbursement_temp_analysis WHERE BL = '$mbl' AND ContainerNo='$containerNo' AND Username <>'$Uname'");

    //Different user processing the BL
    if (mysqli_num_rows($b) > 0) {

        $bn = mysqli_fetch_assoc($b);

        $result = [
            'status_code' => 503,
            'msg' => "$mbl BL already loaded by User [" . $bn['Username'] . ']. Verify and clear disbursement analysis.',
            'bl' => $mbl,
            'hbl' => $hbl,

        ];
    } else {

        //If User has selected a different BL aside the current one
        $d = mysqli_query($dbc, "SELECT * FROM  disbursement_temp_analysis WHERE Username='$Uname' AND BL <> '$mbl'");

        if (mysqli_num_rows($d) > 0) {

            //$dn = mysqli_fetch_assoc($d);

            $result = [
                'status_code' => 301,
                'msg' => "You already initiated a disbursement analysis. Continue or clear disbursement",
            ];
        } else {

            $e = mysqli_query($dbc, "SELECT * FROM  disbursement_temp_analysis WHERE Username='$Uname' AND BL = '$mbl' AND HouseBL='$hbl'  AND ContainerNo='$containerNo'");

            if (mysqli_num_rows($e) > 0) {
                $result = [
                    'status_code' => 201,
                    'msg' => 'Disbursement details already loaded.',
                ];
            } else {
                $a = mysqli_query($dbc, "SELECT * FROM disbursement_accounts");

                if (mysqli_num_rows($a) == 0) {
                    $result = [
                        'status_code' => 501,
                        'msg' => 'Disbursement Account Not Mapped',
                    ];
                } else {

                    $mbl == $hbl ? $type = 'FCL' : $type = 'LCL1';

                    $dbc->autocommit(false);
                    $status = 2;

                    while ($an = mysqli_fetch_assoc($a)) {

                         $f = mysqli_query($dbc, "SELECT * FROM  disbursement_analysis WHERE BL = '$mbl'  AND ContainerNo='$containerNo' AND AccountID='$an[AccountNo]'");
                            if (mysqli_num_rows($f) > 0) {
                                $status = 0;
                            }else{
                                $status = 2;
                            }


                        $b = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES('$an[AccountNo]','$mbl','$hbl','$containerNo','$consigneeID','0','$type','$status','$Uname','$ajaxTime')");
                    }

                    // $c = mysqli_query($dbc, "INSERT INTO disbursement_temp_analysis VALUES('$disbursement_income_account','$mbl','$hbl','$consigneeID','0','INCOME','FCL','$Uname','$ajaxTime')");

                    if ($b) {
                        $dbc->commit(TRUE);

                        $result = [
                            'status_code' => 201,
                            'msg' => 'Disbursement Account Loaded Successfully',
                        ];
                    } else {
                        $result = [
                            'status_code' => 503,
                            'msg' => 'Error loading disbursement accounts',
                        ];
                    }
                }
            }
        }

        //$b = mysqli_query($dbc, "SELECT * FROM ");

    }


    echo json_encode($result);
}
