<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns =  intval(trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$cnm =  (trim(mysqli_real_escape_string($dbc, $_POST['cnm'])));
$mbl =  trim(mysqli_real_escape_string($dbc, $_POST['mbl']));
$hbl =  trim(mysqli_real_escape_string($dbc, $_POST['hbl']));
$dt =  trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d', strtotime($_POST['dt']))));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($cnm == '') {
    die('Missing Consignment ID');
} elseif ($cns == '') {
    die('Missing Consignee ID');
} elseif ($mbl == '') {
    die('Missing Main BL');
} elseif ($hbl == '') {
    die('Missing House BL');
} else {
    $a = mysqli_query($dbc, "select * from handling_charge");

    if (mysqli_num_rows($a) == 0) {
        die('Handling charge(s) account not yet mapped');
    } else {
        $d = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp where ConsigneeID='$cns' and Username<>'$Uname'");
        if (mysqli_num_rows($d) > 0) {
            $dn = mysqli_fetch_assoc($d);
            die('Consignee invoice already in process by <' . $dn['Username'] . '>');
        } else {
            //$b = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp where Username='$Uname'");

            $dbc->autocommit(FALSE);

            $c = $dbc->query("delete from hbl_invoice_consignee_temp where Username='$Uname'");
            while ($an = mysqli_fetch_assoc($a)) {
                $b = $dbc->query("insert into hbl_invoice_consignee_temp values('$cnm','$mbl','$hbl','$cns','$an[AccountNo]','0','0','0','$an[Amount]','$ajaxDate','$ajaxTime','$Uname')");
            }

            if ($c and $b) {
                $dbc->commit();
                echo '1';
            } else {
                die($ERR);
            }
        }
    }
}
