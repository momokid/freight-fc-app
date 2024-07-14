<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$rid =  (trim(mysqli_real_escape_string($dbc, $_POST['rid'])));
$rno =  (trim(mysqli_real_escape_string($dbc, $_POST['rno'])));
$cid =  (trim(mysqli_real_escape_string($dbc, $_POST['cid'])));
$desc = (trim(mysqli_real_escape_string($dbc, $_POST['desc'])));
$name = (trim(mysqli_real_escape_string($dbc, $_POST['name'])));
$mbl = (trim(mysqli_real_escape_string($dbc, $_POST['mbl'])));
$hbl = (trim(mysqli_real_escape_string($dbc, $_POST['hbl'])));
$dt =  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} elseif ($rid == '') {
    die('Missing Transaction ID');
} elseif ($rno == '') {
    die('Missing Transaction No.');
} elseif ($name == '' and $cid == '') {
    die('Select Client Name');
} elseif ($dt == '' | $dOT==='1970-01-01') {
    die('Select date of transaction');
} else {
    $a = mysqli_query($dbc, "select * from temp_other_invoice_non_manifest_view_0 where Username='$Uname'");

    if (mysqli_num_rows($a) == 0) {
        die('Client charge(s) not yet added');
    } else {
        $b1 = mysqli_query($dbc, "select * from receipt_main where ReceiptNo='$recno'");
        if (mysqli_num_rows($b1) > 0) {
            die('Receipt No. already exists');
        } else {
            //$bn = mysqli_fetch_assoc($b);

            //Set Student Ctrl and School Fee Receivable Ctrl
            $stc = mysqli_real_escape_string($dbc, $_SESSION['stc']);
            $fc = mysqli_real_escape_string($dbc, $_SESSION['fc']);

            // die($stc);

            if ($fc == '') {
                die('Receivable Account not configured yet' . $fc['AccountID']);
            } elseif ($stc == '') {
                die('Control Account not properly set');
            } else {

                $dbc->autocommit(FALSE);
                $r = mysqli_query($dbc, "insert into receipt_main values('$rid','$dt','$rno','$Uname','$ajaxTime')");

                while ($an = mysqli_fetch_assoc($a)) {
                    $c = mysqli_query($dbc, "insert into other_invoice values('$cid','$desc','$mbl','$hbl','$rno','$an[AccountNo]','BILL','$rno','$an[Amount]','$an[GetFund]','$an[VAT]','$dt','$an[Time]','$Uname','2')");
                    $d = mysqli_query($dbc, "insert into student_fee values('$cid','$mbl','$rno','$an[AccountNo]','BL_NONBL','$an[Description]','$rno','$an[GTotal]','0','$dt','$ajaxTime','$Uname','1')");
                    //$g = mysqli_query($dbc, "insert into journal values('$fc','$fc','Cr','NCash','$rno','0','$an[GTotal]','$an[Description]','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','2')");
                    //$h = mysqli_query($dbc, "insert into journal values('$stc','$cid','Dr','NCash','$rno','$an[GTotal]','0','$an[Description]','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','2')");
                }
                if ($r and $d and $c and $g and $h) {
                    $e = mysqli_query($dbc, "delete from temp_other_invoice_non_manifest where Username='$Uname'");
                    if ($e) {
                        $dbc->commit();
                        echo '1';
                    } else {
                        die($ERR);
                    }
                } else {
                    die($ERR);
                }
            }
        }
    }
}
