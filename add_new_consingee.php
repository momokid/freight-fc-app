<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$shpid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['shpid'])));
$shpnm=  trim(mysqli_real_escape_string($dbc,$_POST['shpnm']));
$shpadd1=  trim(mysqli_real_escape_string($dbc,$_POST['shpadd1']));
$shpadd2=  trim(mysqli_real_escape_string($dbc,$_POST['shpadd2']));
$shpadd3=  trim(mysqli_real_escape_string($dbc,$_POST['shpadd3']));
$cnsTel=  trim(mysqli_real_escape_string($dbc,$_POST['cnsTel']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($shpid==''){
    die('Missing Shipper ID');
}elseif($shpnm==''){
    die('Missing Shipper Name');
}elseif($shpadd1==''){
    die('Missing Address Line 1');
}elseif($shpadd2==''){
    die("Missing Addressing Line 2");
}elseif($cnsTel==''){
    die("Missing Telephone No.");
}else{
    $a = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$shpid'");
    
    if(mysqli_num_rows($a)>0){
        die('Shipper ID already exists');
    }else{
        $b = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$shpid'");
        if(mysqli_num_rows($b)>0){
            die('Shipper Name already exists');
        }else{
            $c = mysqli_query($dbc,"insert into consignee_main values('$shpid','$shpnm','$cnsTel','$shpadd1','$shpadd2','$shpadd3','$ajaxDate','$ajaxTime','$Uname','1')");
            if($c){
                echo '1';
            }else{
                die($ERR);
            }
        }
        
        
        
    }
       
        
}

?>