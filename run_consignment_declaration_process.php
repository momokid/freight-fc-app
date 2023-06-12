<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$dcl =  trim(mysqli_real_escape_string($dbc, $_POST['dcl']));
$desc =  trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$recid =  trim(mysqli_real_escape_string($dbc, $_POST['rid']));
$recno =  trim(mysqli_real_escape_string($dbc, $_POST['rno']));
$acc =  trim(mysqli_real_escape_string($dbc, $_POST['acc']));
$dt =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dt']))));
$amt =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amt'])));
$duty =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['duty'])));
$csz =  trim(mysqli_real_escape_string($dbc, $_POST['csz']));
$agnm =  trim(mysqli_real_escape_string($dbc, $_POST['agnm']));
$tel =  trim(mysqli_real_escape_string($dbc, $_POST['tel']));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($dt <= 0) {
    die('Missing Data: Select transaction date');
} elseif ($amt <= 0) {
    die('Missing Data: Enter Amount Charge');
} elseif ($duty <= 0) {
    die('Missing Data: Enter Duty paid');
} elseif ($bl == '') {
    die('Missing Data: Enter BL No.');
} elseif ($dt == '') {
    die('Missing Data: Enter Declaration No.');
} elseif ($desc == '') {
    die('Missing Data: Enter Item Description ');
} elseif ($recid == '' or $recno == '') {
    die('Missing Data: Invalid Transaction ID/No');
} elseif ($agnm == '') {
    die('Missing Data: Enter Agent\'s Name');
} elseif ($tel == '') {
    die('Missing Data: Enter Agent\'s Contact');
} elseif ($acc == '') {
    die('Missing Data: Select Credit Account');
} elseif ($dt == '1970-01-01') {
    die('Missing Data: Select transaction date');
} else {
    $DclID = 0;

    $z = mysqli_query($dbc, "select * from declaration_main where Declaration='$dcl'");
    if (mysqli_num_rows($z) > 0) {
        die('Error: Declaration No. already exists');
    } else {
        $t = mysqli_query($dbc, "select * from declaration_main where BL='$bl'");
        if (mysqli_num_rows($t) > 0) {
            die('Bill of lading number already processed');
        } else {
            $a = mysqli_query($dbc, "select * from  receipt_main where ReceiptNo='$recno'");
            if (mysqli_num_rows($a) > 0) {
                die('Receipt No already exists ' . $recno);
            } else {

                //$bn = mysqli_fetch_assoc($b);
                if ($dt > $ajaxDate) {
                    die('Transaction must be on or before ' . strftime("%d %b, %Y", strtotime($ajaxDate)));
                } else {

                    //Get Active IE account
                    $inc = mysqli_query($dbc, "select * from  active_ie");
                    if (mysqli_num_rows($inc) <> 1) {
                        die('Active IE account not configured');
                    } else {
                        $in = mysqli_fetch_assoc($inc);

                        $p = mysqli_query($dbc, "select * from declaration_main");
                        if (mysqli_num_rows($p) == 0) {
                            $DclID = 100001;
                        } else {
                            $l = mysqli_query($dbc, "select max(DeclarationID) as ID from declaration_main");
                            $ln = mysqli_fetch_assoc($l);

                            $DclID = $ln['ID'] + 1;
                        }

                        $d = mysqli_query($dbc, "select * from active_declaration_income");
                        if (mysqli_num_rows($d) == 0) {
                            die('Active declaration income account not found');
                        } else {

                            $dn = mysqli_fetch_assoc($d);
                            $dbc->autocommit(FALSE);

                            $e = $dbc->query("insert into receipt_main values('$recid','$dt','$recno','$Uname','$ajaxTime')");
                            $f = $dbc->query("insert into journal values('$acc','$acc','Dr','Cash','$recno','$amt','0','DECLARATION CHARGE IFO ~ $dcl','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                            $m = $dbc->query("insert into journal values('$in[AccountID]','$dn[AccountNo]','Cr','Cash','$recno','0','$amt','DECLARATION CHARGE IFO ~ $dcl','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                            $n = $dbc->query("insert into pnl_transaction values('$dn[AccountNo]','NB','Cr','$bl','$bl','$recno','DECLARATION CHARGE IFO ~ $dcl','0','$amt','$dt','$ajaxTime','$BranchID','$Uname','1')");
                            $i = $dbc->query("insert into declaration_main values('$DclID','$bl','$dcl','$desc','$duty','$amt','$agnm','$tel','$csz','$recno','$dt','$ajaxTime','$Uname','$BranchID','1')");

                            if ($e and $f and $m and $n and $i) {
                                $dbc->commit();
                                echo '1';
                            } else {
                                die($CRC);
                            }
                        }
                    }
                }
            }
        }
    }
}
