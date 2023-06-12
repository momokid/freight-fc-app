<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$pid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['pid'])));
$pnm=  trim(mysqli_real_escape_string($dbc,$_POST['pnm']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($pid==''){
    die('Missing Carrier ID');
}elseif($pnm==''){
    die('Missing Carrier Name');
}else{
    $a = mysqli_query($dbc, "select * from ship_carrier where CarrierID='$pid'");
    
    if(mysqli_num_rows($a)>0){
        die('Carrier ID already exists');
    }else{
        $c = mysqli_query($dbc, "select * from pol where CarrierName='$pnm'");
        if(mysqli_num_rows($c)>0){
            die('Carrier Name already exists.');
        }else{
            
            $b = mysqli_query($dbc,"insert into ship_carrier values('$pid','$pnm','$ajaxTime','$Uname')");
            if($b){
                echo '1';
            }else{
                die($ERR);
            }
            }
        
        
    }
       
        
}

?>