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
    die('Missing P.O.D. ID');
}elseif($pnm==''){
    die('Missing P.O.D. Name');
}else{
    $a = mysqli_query($dbc, "select * from pod where POL_lID='$pid'");
    
    if(mysqli_num_rows($a)>0){
        die('POL ID already exists');
    }else{
        $c = mysqli_query($dbc, "select * from pod where POL_Name='$pnm'");
        if(mysqli_num_rows($c)>0){
            die('P.O.L. Name already exists.');
        }else{
            
            $b = mysqli_query($dbc,"insert into pod values('$pid','$pnm','$ajaxTime','$Uname')");
            if($b){
                echo '1';
            }else{
                die($ERR);
            }
            }
        
        
    }
       
        
}

?>