<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$acc=  intval(trim(mysqli_real_escape_string($dbc,$_POST['acc'])));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));
$taxStatus= (trim(mysqli_real_escape_string($dbc,$_POST['taxStatus'])));
$id= (trim(mysqli_real_escape_string($dbc,$_POST['id'])));
$dt=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($acc==''){
    die('Select Account');
}elseif($amt==='' or $amt<0){
    die('Enter Amount');
}elseif($dt=='1970-01-01'){
    die('Select Transaction Date');
}else{
    
    $a = mysqli_query($dbc, "select * from charge_taxes");
    if(mysqli_num_rows($a)==0){
        die('Taxes not setup');
    }else{
    $e = mysqli_query($dbc, "SELECT * FROM temp_other_invoice_non_manifest where Username='$Uname' and AccountNo='$acc'");

    if(mysqli_num_rows($e)>0){
        $c = mysqli_query($dbc, "UPDATE temp_other_invoice_non_manifest SET Amount='$amt' where Username='$Uname' and AccountNo='$acc' ");
        if($c){
            echo '1';
        }else{
            die(mysqli_error($dbc));
        }
    }else{
        $an = mysqli_fetch_assoc($a);

        if($taxStatus == 'false'){
            $an['GetFund']=0;
            $an['VAT']=0;
            $an['Covid']=0;
        }

        $c = $dbc->query("INSERT INTO temp_other_invoice_non_manifest VALUES('','$acc','$amt','$taxStatus','$an[GetFund]','$an[NHIL]','$an[Covid]','$an[VAT]','$Uname','$ajaxTime') ");

        if($c){
            echo '1';
        }else{
            die('$ERR');
        }
     }

    }
}       
    
 

?>