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
$desc=  (trim(mysqli_real_escape_string($dbc,$_POST['desc'])));
$dt=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dot']))));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($acc==''){
    die('Select Account');
}elseif($amt=='' or $amt<=0){
    die('Enter Amount');
}elseif($desc==''){
    die('Enter Description');
}else{
    $a = mysqli_query($dbc, "select * from charge_taxes");
    if(mysqli_num_rows($a)==0){
        die('Taxes not setup');
    }else{
    $e = mysqli_query($dbc, "select * from temp_other_invoice where Username='$Uname' and AccountNo='$acc'");

    if(mysqli_num_rows($e)>0){
        $c = mysqli_query($dbc, "update temp_other_invoice set Amount='$amt',Description='$desc' where Username='$Uname' and AccountNo='$acc' ");
        if($c){
            echo '1';
        }else{
            die(mysqli_error($dbc));
        }
    }else{
        $an = mysqli_fetch_assoc($a);
        $c = $dbc->query("insert into temp_other_invoice values('','$acc','$amt','$desc','$an[GetFund]','$an[VAT]','$Uname','$ajaxTime') ");

        if($c){
            echo '1';
        }else{
            die($ERR);
        }
     }

    }
}       
    
 

?>