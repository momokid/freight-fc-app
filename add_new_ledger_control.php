<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['CID'])));
$cnm=  trim(mysqli_real_escape_string($dbc,$_POST['CNM']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($cid==''){
    die('Missing Control ID');
}elseif($cnm==''){
    die('Missing Control Name');
}else{
    $a = mysqli_query($dbc, "select * from ledger_control where ControlID='$cid'");
    
    if(mysqli_num_rows($a)>0){
        die('Control ID already exists');
    }else{
        $b = mysqli_query($dbc, "select * from ledger_control where ControlName='$cnm'");
        if(mysqli_num_rows($b)>0){
            die('Control Name already exists '.$cnm);
        }else{
            $c = mysqli_query($dbc,"insert into ledger_control values('$cid','$cnm','$Uname','$ajaxDate','$ajaxTime','1')");
            if($c){
                echo '1';
            }else{
                die($ERR);
            }
        }
    }
       
        
}

?>