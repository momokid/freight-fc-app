<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$stid =  trim(mysqli_real_escape_string($dbc, $_POST['stid']));
//$note=  trim(mysqli_real_escape_string($dbc,$_POST['note']));
$desc =  trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$recid =  trim(mysqli_real_escape_string($dbc, $_POST['recid']));
$recno =  trim(mysqli_real_escape_string($dbc, $_POST['recno']));
$dt =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dt']))));
$amt =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amt'])));
$accid =  trim(mysqli_real_escape_string($dbc, $_POST['acc']));
$hbl =  trim(mysqli_real_escape_string($dbc, $_POST['hbl']));
$mbl =  trim(mysqli_real_escape_string($dbc, $_POST['mbl']));

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
} elseif ($hbl == '') {
    $res = [
        'code' => 301,
        "msg" => "Missing Data: House BL#"
    ];
} else {
    $z = mysqli_query($dbc, "SELECT * FROM container_main WHERE ConsigneeID='$stid' AND MainBL='$mbl' ");
    if (mysqli_num_rows($z) ==0) {
        $res = [
            'code' => 301,
            "msg" => "Error: Invoice must be generated before payment can be processed.",
        ];
    } else {
        $zn = mysqli_fetch_assoc($z);

        $rcpt = getReceiptDetails($dt);

        if ($rcpt['number'] === "") {
            $res = [
                'code' => 301,
                "msg" => "Error Generating Receipt No."
            ];
        // } else {

        //     if ($dt < $zn['Date']) {
        //         $res = [
        //             'code' => 301,
        //             "msg" => 'All payments must be after ' . strftime("%d %b, %Y", strtotime($zn['Date']))
        //         ];
        //     } else {

                $c = mysqli_query($dbc, "SELECT * FROM bl_invoice_payment WHERE MainBL='$mbl' AND ConsigneeID='$stid' ");
                $cn = mysqli_fetch_assoc($c);

                $invoice_paid = $cn['Fee'] ?? 0;

                if ($invoice_paid == $amt) {
                    $res = [
                        'code' => 301,
                    "msg" => 'The balance on the invoice is less than ' . formatToCurrency($amt) .'~'.$rcpt['number'],
                    ];
                } else {

                    //Find the highest number in ccdb
                    // $cc = mysqli_query($dbc, "select * from ccdb");
                    // if (mysqli_num_rows($cc) == 0) {
                    //     $ccd = '1';
                    // } else {
                    //     $cc2 = mysqli_query($dbc, "select max(ID) as ID from ccdb");
                    //     $ccn = mysqli_fetch_assoc($cc2);

                    //     $ccd = intval($ccn['ID']) + 1;
                    // }

                    //get active pnl
                    $activePNL = getActivePNL();

                    if (!$activePNL) {
                        $res = [
                            'code' => 301,
                            "msg" => 'Active IE account not configured',
                        ];

                    } else {

                        $d = mysqli_query($dbc, "SELECT * FROM bl_invoice WHERE ConsigneeID='$stid' AND MainBL='$mbl' ");

                            //Set Student Ctrl and School Fee Receivable Ctrl
                            // $stc = mysqli_real_escape_string($dbc, $_SESSION['stc']);
                            // $fc = mysqli_real_escape_string($dbc, $_SESSION['fc']);

                            // if ($fc == '') {
                            //     die('Fee Receivable Account not configured yet' . $fc['AccountID']);
                            // } elseif ($stc == '') {
                            //     die('Student Control Account not properly set');
                            // } else {

                            // floatval($NB = $amt);

                            $dbc->autocommit(FALSE);

                            $receipt_number = $dbc->query("INSERT INTO receipt_main VALUES('$rcpt[Id]','$dt','$rcpt[number]','$Uname','$ajaxTime')");
                            $journal_income_dr = $dbc->query("INSERT INTO journal VALUES('$accid','$accid','Dr','Cash','$rcpt[number]','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                            //$m = $dbc->query("INSERT INTO journal VALUES('$fc','$fc','Cr','NCash','$recno','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                            //$n = $dbc->query("INSERT INTO journal VALUES('$stc','$stc','Dr','NCash','$recno','0','$amt','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                            $invoice_payment = $dbc->query("INSERT INTO bl_invoice_payment  VALUES('$zn[ConsignmentID]','$zn[MainBL]','$zn[ReceiptNo]','$zn[ConsigneeID]','$rcpt[number]','$amount','$desc','BL','$dt','$ajaxTime','$Uname','1')");

                         //  while ($dn = mysqli_fetch_assoc($d)) {
                                // if ($NB >= $dn['Balance']) {

                                 //   $pnl_income = $dbc->query("INSERT INTO pnl_transaction VALUES('$dn[AccountNo]','BL','Cr','$zn[MainBL]','$zn[MainBL]','$rcpt[number]','$desc','0','$dn[Fee]','$dt','$ajaxTime','$BranchID','$Uname','1')");
                                 //   $journal_income_cr = $dbc->query("INSERT INTO journal VALUES('$in[AccountID]','$dn[AccountNo]','Cr','Cash','$rcpt[number]','0','$dn[Fee]','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                                    
                                    // if ($g and $g1) {
                                    //     // $dbc->commit();

                                    // } else {
                                    //     die($ERR);
                                    // }

                                    // $NB = $NB - $dn['Balance'];
                                    // if ($NB <= 0) {
                                    //     $h1 = mysqli_query($dbc, "select * from kaina");
                                    //     $h2 = mysqli_query($dbc, "select * from kaina");
                                    //     $h = mysqli_query($dbc, "select * from kaina");
                                    //     break;
                                    // }
                                // } elseif ($NB < $dn['Balance']) {
                                //     $h = $dbc->query("INSERT INTO student_fee VALUES('$stid','$zn[MainBL]','$zn[HouseBL]','$dn[AccountNo]','BL','$desc','$recno','0','$NB','$dt','$ajaxTime','$Uname','1')");
                                //     $h1 = $dbc->query("INSERT INTO pnl_transaction VALUES('$dn[AccountNo]','BL','Cr','$zn[MainBL]','$zn[HouseBL]','$recno','$desc','0','$NB','$dt','$ajaxTime','$BranchID','$Uname','1')");
                                //     $h2 = $dbc->query("INSERT INTO journal VALUES('$in[AccountID]','$dn[AccountNo]','Cr','NCash','$recno','0','$NB','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                                //     if ($h and $h1) {
                                //         //$dbc->commit();

                                //     } else {
                                //         die($ERR);
                                //     }
                                //     $g1 = mysqli_query($dbc, "select * from kaina");
                                //     $g2 = mysqli_query($dbc, "select * from kaina");
                                //     $g = mysqli_query($dbc, "select * from kaina");
                                //     break;
                                // }
                                // echo $dn['AccountName']." is ".$dn['Balance']." and the Order is ".$dn['PmtOrder']." ";

                           // }
                            //$ccdb = $dbc->query("INSERT INTO ccdb VALUES('$ccd','$desc IFO ~$stid on $dt','$Uname','$ajaxTime')");

                            if ($receipt_number) {
                                $dbc->commit();
                                
                                $res = [
                                    'code' => 201,
                                    "msg" => 'Invoice payment was successfully',
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
