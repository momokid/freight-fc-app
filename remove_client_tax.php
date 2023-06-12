<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$acc =  intval(trim(mysqli_real_escape_string($dbc,$_POST['acc'])));

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($acc==''){
    die('Missing Account Details');
}else{
    $a = mysqli_query($dbc, "select * from temp_other_invoice where AccountNo='$acc'");
    
    if(mysqli_num_rows($a)==0){
        die('Charges on account not found');
    }else{
       $c = mysqli_query($dbc, "update temp_other_invoice set GetFund='0', VAT='0' where AccountNo='$acc' and Username='$Uname'");
       if($c){
           echo '1';
       }else{
           die($ERR);
       }
    }
    
        
}

?>