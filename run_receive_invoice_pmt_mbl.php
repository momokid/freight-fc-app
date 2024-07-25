<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$cns =  trim(mysqli_real_escape_string($dbc, $_POST['cns']));
//$note=  trim(mysqli_real_escape_string($dbc,$_POST['note']));
$desc =  trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$dt =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));
$amt =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amt'])));
$accid =  trim(mysqli_real_escape_string($dbc, $_POST['acc']));
$mbl =  trim(mysqli_real_escape_string($dbc, $_POST['mbl']));

$res = [
    'msg' => "sample data"
];

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($amt <= 0) {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: Enter Amount Paid"
    ];
} elseif ($accid == '') {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: Select Cash Account"
    ];
} elseif ($dt == '') {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: Select Transaction Date"
    ];
} elseif ($desc == '') {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: Enter Transaction Description"
    ];
} elseif ($mbl == '') {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: Main BL# not found"
    ];
} else {
    $z = mysqli_query($dbc, "SELECT * FROM container_main WHERE ConsigneeID='$cns' AND BL='$mbl' ");
    if (mysqli_num_rows($z) == 0) {
        $res = [
            'code' => 301,
            "msg" => "Error: Container details with BL# [$cns] not captured.",
        ];
    } else {
        $zn = mysqli_fetch_assoc($z);

        $rcpt = getReceiptDetails($dt);

        // die('Ready');

        if ($rcpt['number'] !== "") {
            $res = [
                'code' => 301,
                "msg" => "Error Generating Receipt No."
            ];


            $c = mysqli_query($dbc, "SELECT * FROM handling_charge_main WHERE MainBL='$mbl' ");

            if (mysqli_num_rows($c) > 0) {
                $res = [
                    'code' => 301,
                    "msg" => 'Handling Charge payment already captured for BL# ' . $mbl,
                ];
            } else {

                $cn = mysqli_fetch_assoc($c);

                //get active pnl
                $activePNL = getActivePNL();

                //Get Handling Charge income account
                $activeHandlingChargeIncome = getHandlingChargeIncome();

                if (!$activeHandlingChargeIncome && !$activePNL) {
                    $res = [
                        'code' => 301,
                        "msg" => "Default  income accounts are not configured properly.",
                    ];
                } else {

                    $dbc->autocommit(FALSE);

                    $receipt_number = $dbc->query("INSERT INTO receipt_main VALUES('$rcpt[Id]','$dt','$rcpt[number]','$Uname','$ajaxTime')");
                    $journal_income_dr = $dbc->query("INSERT INTO journal VALUES('$accid','$accid','Dr','Cash','$rcpt[number]','$amt','0','HANDLING CHARGE ~ $desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");

                    $pnl_income = $dbc->query("INSERT INTO pnl_transaction VALUES('$activeHandlingChargeIncome','BL','Cr','$mbl','$mbl','$rcpt[number]','HANDLING CHARGE ~ $desc','0','$amt','$dt','$ajaxTime','$BranchID','$Uname','1')");
                    $journal_income_cr = $dbc->query("INSERT INTO journal VALUES('$activePNL','$activeHandlingChargeIncome','Cr','Cash','$rcpt[number]','0','$amt','HANDLING CHARGE ~ $desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                    $handling_charge = $dbc->query("INSERT INTO handling_charge_main VALUES('$mbl','$rcpt[number]','$amt','HANDLING CHARGE ~ $desc','$dt','$ajaxTime','$Uname','$BranchID','1')");


                    if ($receipt_number) {
                        $dbc->commit();

                        $res = [
                            'code' => 200,
                            "msg" => 'Invoice payment was successfully',
                            "receiptNo"=>$rcpt['number'],
                        ];
                    } else {
                        $res = [
                            'code' => 301,
                            "msg" => $ERR,
                        ];
                    }
                }
            }
        }
    }
}

echo json_encode($res);
