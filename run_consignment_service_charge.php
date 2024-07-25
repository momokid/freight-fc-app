<?php

//start the session
session_start();

//Database connection
include 'cn/cn.php';

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl = trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$dcl = trim(mysqli_real_escape_string($dbc, $_POST['dcl']));
$dcl_id = trim(mysqli_real_escape_string($dbc, $_POST['dcl_id']));
$desc = trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$recid = trim(mysqli_real_escape_string($dbc, $_POST['rid']));
$recno = trim(mysqli_real_escape_string($dbc, $_POST['rno']));
$acc = trim(mysqli_real_escape_string($dbc, $_POST['acc']));
$dt = trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d', strtotime($_POST['dt']))));
$amt = floatval(trim(mysqli_real_escape_string($dbc, $_POST['amt'])));
$cons = trim(mysqli_real_escape_string($dbc, $_POST['cons']));
$cons_id = trim(mysqli_real_escape_string($dbc, $_POST['cons_id']));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($bl == '') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Enter BL No."
    ];
} elseif ($dcl == '') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Enter Declaration No."
    ];
} elseif ($desc == '') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Enter Item Description"
    ];
} elseif ($cons == '') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Enter Consignee\'s Name"
    ];
} elseif ($amt <= 0) {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Enter Amount Charge"
    ];
} elseif ($acc == '') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Select Credit Account"
    ];
} elseif ($dt == '1970-01-01') {
    $res = [
        "code" => 301,
        "msg" => "Missing Data: Select transaction date"
    ];
}  else {


    if ($dcl_id === '') {
        $dcl_id = '0';
    }
    if ($cons_id === '') {
        $cons_id = '0';
    }

    $DclID = 0;

    $z = mysqli_query(
        $dbc,
        "SELECT * FROM  service_charge_main WHERE DeclarationNo='$dcl'"
    );
    if (mysqli_num_rows($z) > 0) {
        $res = [
            "code" => 301,
            "msg" => "Error: Declaration No. already exists"
        ];
    } else {
        $t = mysqli_query(
            $dbc,
            "SELECT * FROM  service_charge_main WHERE BL='$bl'"
        );
        if (mysqli_num_rows($t) > 0) {
            $res = [
                "code" => 301,
                "msg" => "Service charge for BL# [$bl] already captured."
            ];
        } else {
            //get receipt number and id
            $rcpt = getReceiptDetails($dt);

            //get active pnl
            $activePNL = getActivePNL();

            //get servcie charge income account
            $serviceChargeId = getServiceChargeID();

            //Get service charge income
            $serviceChargeIncome = getServiceChargeIncome();

            //$dn = mysqli_fetch_assoc($d);

            $dbc->autocommit(false);

            $receipt_number = $dbc->query("INSERT INTO receipt_main VALUES('$rcpt[Id]','$dt','$rcpt[number]','$Uname','$ajaxTime')");

            $pnl_income = $dbc->query("INSERT INTO pnl_transaction VALUES('$serviceChargeIncome','NB','Cr','$bl','$bl','$rcpt[number]','SERVICE CHARGE IFO ~ $dcl~$bl','0','$amt','$dt','$ajaxTime','$BranchID','$Uname','1')");

            $service_charge = $dbc->query("INSERT INTO service_charge_main VALUES('$DclID','$bl','$dcl_id','$dcl','$cons_id','$cons','$desc','$amt','$rcpt[number]','$dt','$ajaxTime','$Uname','$BranchID','1')");

            $journal_dr = $dbc->query("INSERT INTO journal VALUES('$acc','$acc','Dr','Cash','$rcpt[number]','$amt','0','SERVICE CHARGE IFO ~ $dcl~$bl','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
           
            $journal_cr = $dbc->query("INSERT INTO journal VALUES('$activePNL','$serviceChargeIncome','Cr','Cash','$rcpt[number]','0','$amt','SERVICE CHARGE IFO ~ $dcl~$bl','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
           
            
            if ($receipt_number) {

                $dbc->commit();

                $res = [
                    "code" => 200,
                    "msg" => "Service charge payment saved successfully"
                ];
            } else {
                $res = [
                    "code" => 301,
                    "msg" => $CRC,
                ];
            }
        }
    }
}


echo json_encode($res);
