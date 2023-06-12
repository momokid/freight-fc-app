<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$dr=  trim(mysqli_real_escape_string($dbc,$_POST['exp_acc']));
$cr=  trim(mysqli_real_escape_string($dbc,$_POST['acc']));
$desc=  trim(mysqli_real_escape_string($dbc,$_POST['desc']));
$recid=  trim(mysqli_real_escape_string($dbc,$_POST['recid']));
$recno=  trim(mysqli_real_escape_string($dbc,$_POST['recno']));
$dt=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dt']))));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));
$mbl=  trim(mysqli_real_escape_string($dbc,$_POST['mbl']));
$cns=  trim(mysqli_real_escape_string($dbc,$_POST['cns']));


if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($amt<=0){
    die('Missing Data: Enter Amount');
}elseif($cr==''){
    die('Missing Data: Select Cash Account');
}elseif($dr==''){
    die('Missing Data: Select Expenditure Account');
}elseif($dt==''){
    die('Missing Data: Enter Transaction Description');
}elseif($desc==''){
    die('Missing Data: Enter Transaction Description ');
}elseif($recid=='' or $recno==''){
    die('Missing Data: Invalid Transaction ID/No');
}else{
    $c = mysqli_query($dbc, "select * from container_exp_pmt_3 where MainBL='$mbl'");
    if(mysqli_num_rows($c)<>1){
        die('Multi consignment details found. Contact your system administrator.');
    }else{
        $cn = mysqli_fetch_assoc($c);
        if($cn['Balance']<$amt){
            die('Epxenditure amount cannot be more than '.$cn['Balance']);
        }elseif($dt < $cn['TDate']){
            die('Transaction date cannot be before '.strftime("%b %d, %Y", strtotime($cn['TDate'])));
        }else{
            $f = mysqli_query($dbc, "select * from active_ie");
            if(mysqli_num_rows($f)>1){
                die('P&L account not configured');
            }else{
                $fn = mysqli_fetch_assoc($f);

                $a = mysqli_query($dbc, "select * from  receipt_main where ReceiptNo='$recno'");
                if(mysqli_num_rows($a)>0){
                    die('Trasaction No. already exists');
                }elseif($dr==$cr){
                    die('Credit Account cannot be the same as Debit Account.');
                }else{
                    
                    $dbc->autocommit(FALSE);
                    $d  = $dbc->query("insert into receipt_main values('$recid','$dt','$recno','$Uname','$ajaxTime')");
                    $b = $dbc->query("insert into journal values('$fn[AccountID]','$dr','Dr','NCash','$recno','$amt','0','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                    $c = $dbc->query("insert into journal values('$cr','$cr','Cr','NCash','$recno','0','$amt','$desc','$dt','$ajaxTime','$Uname','N.Auth','$BranchID','1')");
                    $g = $dbc->query("insert into pnl_transaction values('$dr','NB','Dr','$mbl','$cns','$recno','$desc','$amt','0','$dt','$ajaxTime','$BranchID','$Uname','1')");
                    if($b and $c and $g and $d){
                        $dbc->commit();
                        echo '1';
                    }else{
                        die($ERR);
                    }
                   }
            }
          }  
        }
        
}
?>