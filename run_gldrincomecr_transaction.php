<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$glDr =  trim(mysqli_real_escape_string($dbc, $_POST['glDr']));
$glCr =  trim(mysqli_real_escape_string($dbc, $_POST['glCr']));
$desc =  trim(mysqli_real_escape_string($dbc, $_POST['desc']));
$recid =  trim(mysqli_real_escape_string($dbc, $_POST['rid']));
$recno =  trim(mysqli_real_escape_string($dbc, $_POST['rno']));
$dt =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));
$amt =  floatval(trim(mysqli_real_escape_string($dbc, $_POST['amt'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($glDr == '') {
    die('Missing Data: Select Debit Account');
} elseif ($glCr == '') {
    die('Missing Data: Select Credit Account');
} elseif ($amt <= 0) {
    die('Missing Data: Enter Amount');
} elseif ($dt === '' || $dt === '1970-01-01') {
    die('Missing Data: Select Transaction Date');
} elseif ($desc == '') {
    die('Missing Data: Enter Transaction Description ');
} elseif ($recid == '' or $recno == '') {
    die('Missing Data: Invalid Transaction ID/No ' . $recno);
} else if ($glDr === $glCr) {
    die('Debit account and Credit account cannot be the same');
} else {
    $a = mysqli_query($dbc, "select * from  ledger_account where AccountNo='$glDr'");
    if (mysqli_num_rows($a) <> 1) {
        die('Error: Debit account doest not exist');
    } else {
        $b = mysqli_query($dbc, "select * from  ledger_account where AccountNo='$glCr'");
        if (mysqli_num_rows($b) <> 1) {
            die('Error: Credit account does not exists');
        } else {

            $c = mysqli_query($dbc, "select * from  receipt_main where ReceiptNo='$recno'");
            if (mysqli_num_rows($c) > 0) {
                die('Receipt No already exists ');
            } else {

                if ($dt > $ajaxDate) {
                    die('All transactions must be before ' . strftime("%d %b, %Y", strtotime($ajaxDate)));
                } else {

                    //Get Activ IE account
                    $d = mysqli_query($dbc, "select * from  active_ie");
                    if (mysqli_num_rows($d) <> 1) {
                        die('Active IE account not configured');
                    } else {
                        $dn = mysqli_fetch_assoc($d);

                        $dbc->autocommit(FALSE);

                        $e = $dbc->query("insert into receipt_main values('$recid','$dt','$recno','$Uname','$ajaxTime')");
                        $f = $dbc->query("insert into journal values('$glDr','$glDr','Dr','NCash','$recno','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                        $m = $dbc->query("insert into journal values('$dn[AccountID]','$glCr','Cr','NCash','$recno','0','$amt','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                        $g = $dbc->query("insert into pnl_transaction values('$glCr','NB','Cr','DrGLCrInc','DrGLCrInc','$recno','$desc','0','$amt','$dt','$ajaxTime','$BranchID','$Uname','1')");
                        if ($e and $f and $m and $g) {
                            $dbc->commit();
                            echo '1';
                        } else {
                            die($ERR);
                        }
                    }
                }
            }
        }
    }
}
