<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}else{
    $a = mysqli_query($dbc, "select * from ledger_account");
    
    if(mysqli_num_rows($a)==0){
        echo '500';
    }else{
        $b = mysqli_query($dbc, "select max(AccountNo) as ID from ledger_account");
        
        $bn = mysqli_fetch_assoc($b);
        
        echo $bn['ID']+1;
    }
    
}