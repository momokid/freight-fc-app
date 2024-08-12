<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$shpid =  intval(trim(mysqli_real_escape_string($dbc, $_POST['shpid'])));
$cid =  intval(trim(mysqli_real_escape_string($dbc, $_POST['cid'])));
$cns =  intval(trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$vessel =  trim(mysqli_real_escape_string($dbc, $_POST['vessel']));
$dot =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));
$eta =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['eta']))));
$dois =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dois']))));
$sob =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['sob']))));
$pois =  trim(mysqli_real_escape_string($dbc, $_POST['pois']));
$bl =  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$polid =  trim(mysqli_real_escape_string($dbc, $_POST['polid']));
$podid =  trim(mysqli_real_escape_string($dbc, $_POST['podid']));
$carid =  trim(mysqli_real_escape_string($dbc, $_POST['carid']));
$rtt =  trim(mysqli_real_escape_string($dbc, $_POST['rtt']));
$vyg =  trim(mysqli_real_escape_string($dbc, $_POST['vyg']));
$agent =  trim(mysqli_real_escape_string($dbc, $_POST['agent']));
$recid =  trim(mysqli_real_escape_string($dbc, $_POST['rcptid']));
$recno =  trim(mysqli_real_escape_string($dbc, $_POST['rcptno']));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($shpid == '') {
    die('Missing Shipper Details');
} elseif ($cid == '') {
    die('Missing Congsinment ID');
} elseif ($vessel == '') {
    die('Missing Vessel Name');
} elseif ($vyg == '') {
    die('Enter Voyage No.');
} elseif ($dot == '') {
    die('Missing Date of Transaction');
} elseif ($eta == '') {
    die('Missing ETA');
} elseif ($bl == '') {
    die('Missing Bill of Laden');
} elseif ($dois == '') {
    die('Select Date of Issue');
} elseif ($pois == '') {
    die('Enter Place of Issue');
} elseif ($sob == '') {
    die('Select Shipped on Board [Date]');
} elseif ($polid == '') {
    die('Missing P.O.L.');
} elseif ($podid == '') {
    die('Missing P.O.D.');
} elseif ($carid == '') {
    die('Select Shipping Line');
} elseif ($rtt == '') {
    die('Enter Rotation No.');
} elseif ($agent == '') {
    die('Missing agent\'s contact');
} elseif ($recid == '' || $recno == '') {
    die('Transaction Nos. not found');
} else if($cns == ''){
    die("Select Consignee Name");
}else {
    $a = mysqli_query($dbc, "select * from ledger_control where ControlID='$cid'");
    $f = mysqli_query($dbc, "select * from active_handling_cost");
    $inc = mysqli_query($dbc, "select * from  active_ie");
    $v = mysqli_query($dbc, "select * from active_vault");

    if (mysqli_num_rows($v) <> 1) {
        die("Vault account not properly configured");
    }
    $vn = mysqli_fetch_assoc($v);

    if (mysqli_num_rows($inc) <> 1) {
        die('Active IE account not configured');
    }
    $in = mysqli_fetch_assoc($inc);

    if (mysqli_num_rows($f) <> 1) {
        die("Handling charges account not confirgured");
    }
    $fn = mysqli_fetch_assoc($f);

    if (mysqli_num_rows($a) > 0) {
        die('Control ID already exists');
    } else {
        $b = mysqli_query($dbc, "select * from container_main where ConsignmentID='$cid'");
        if (mysqli_num_rows($b) > 0) {
            die('Consignment ID already exists' . $cid);
        } else {
            $d = mysqli_query($dbc, "select * from container_main where BL='$bl'");
            if (mysqli_num_rows($d) > 0) {
                die('Bill of Lading already used');
            } else {
                $d = mysqli_query($dbc, "select * from new_container_temp where Username='$Uname' and BOL='$bl'");
                $a = mysqli_query($dbc, "select * from new_container_temp where Username='$Uname' and BOL='$bl'");

                if (mysqli_num_rows($d) == 0) {
                    die("Please add container details with matching bill of laden no.");
                }

                if ($dot > $ajaxDate) {
                    die('D.O.T. must be on or before ' . strftime("%d %b, %Y", strtotime($ajaxDate)));
                }

                $q = mysqli_query($dbc, "SELECT * from receipt_main where ReceiptNo='$rcpt'");
                if (mysqli_num_rows($q) > 0) {
                    die("Receipt no. already exist");
                }

                $dbc->autocommit(FALSE);
                $an = mysqli_fetch_assoc($a);
                $r = $dbc->query("insert into receipt_main values('$recid','$dot','$recno','$Uname','$ajaxTime')");
                $c = $dbc->query("insert into container_main values('$cid','$carid','$cns','$rtt','$shpid','$vessel','$vyg','$an[SealNo]','$eta','$bl','$an[ContainerNo]','$an[ContainerSize]','$recno','$pois','$dois','$sob','$polid','$podid','0','0','$agent','NO_OFFICER','$Uname','$BranchID','$dot','$ajaxTime','$ajaxTime','1')");

                while ($dn = mysqli_fetch_assoc($d)) {
                    $e = $dbc->query("INSERT INTO container_details values('$cid','$bl','$dn[SealNo]','$dn[ContainerNo]','$dn[ContainerSize]','$dn[Weight]','$dn[HandlingCost]','$Uname','$BranchID','$dot','$ajaxTime')");
                    //$f = $dbc->query("INSERT INTO journal values('$vn[AccountNo]','$vn[AccountNo]','Dr','Cash','$recno','$dn[HandlingCost]','0','CONSIGNMENT PROCESSING CHARGES IFO ~ $dn[ContainerNo]~$bl','$dot','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                    //$m = $dbc->query("INSERT INTO journal values('$in[AccountID]','$fn[AccountNo]','Cr','Cash','$recno','0','$dn[HandlingCost]','CONSIGNMENT PROCESSING CHARGES IFO ~ $dn[ContainerNo]~$bl','$dot','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                    $n = $dbc->query("INSERT INTO pnl_transaction values('$fn[AccountNo]','BL','Cr','$bl','$dn[ContainerNo]','$recno','CONSIGNMENT PROCESSING CHARGES IFO ~ $an[ContainerNo]~$bl','0','$dn[HandlingCost]','$dot','$ajaxTime','$BranchID','$Uname','1')");
                }
                if ($c and $e and $f and $m and $n and $r) {
                    $del = mysqli_query($dbc, "DELETE FROM new_container_temp WHERE Username='$Uname'");
                    $dbc->commit();
                    echo '1';
                } else {
                    die(mysqli_error($dbc));
                }
            }
        }
    }
}
