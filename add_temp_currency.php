<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$crt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['crt'])));
$crn=  trim(mysqli_real_escape_string($dbc,$_POST['crn']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}else{
          
    $a = mysqli_query($dbc, "select * from  currency_conversion"); 
    
    if(mysqli_num_rows($a)==1){
        $b = mysqli_query($dbc, "update  currency_conversion set Rate='$crt', Currency='$crn', Username='$Uname'");
    }else{
       $dbc->autocommit(FALSE);
       
       $b = mysqli_query($dbc, "delete from  currency_conversion");
       $c = mysqli_query($dbc, "insert into  currency_conversion values('$crt','$crn','$Uname')");
       
       if($b and $c){
           $dbc->commit();
           echo '1';
       }else{
           die($ERR);
       }
    }
}

?>