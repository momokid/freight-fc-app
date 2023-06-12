<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['cid'])));
$lnm=  trim(mysqli_real_escape_string($dbc,$_POST['lnm']));
$ctg=  intval(trim(mysqli_real_escape_string($dbc,$_POST['ctgr'])));
$lid=  trim(mysqli_real_escape_string($dbc,$_POST['lid']));
$type=  trim(mysqli_real_escape_string($dbc,$_POST['type']));
$bil=  (trim(mysqli_real_escape_string($dbc,$_POST['bil'])));
$cls=  trim(mysqli_real_escape_string($dbc,$_POST['cls']));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($cid==''){
    die('Missing Control ID');
}elseif($lnm==''){
    die('Missing Ledger Name');
}elseif($lid==''){
    die('Missing Ledger ID');
}elseif($ctg==''){
    die('Missing Ledger Category');
}elseif($type==''){
    die('Missing Ledger Type');
}elseif($cls==''){
    die('Missing Ledger Class');
}elseif($bil==''){
    die('Select Billing Type');
}else{
    $a = mysqli_query($dbc, "select * from ledger_account where AccountNo='$lid'");
    
    if(mysqli_num_rows($a)>0){
        die('Ledger ID already exists');
    }else{
        $b = mysqli_query($dbc, "select * from ledger_account where AccountName='$lnm'");
        if(mysqli_num_rows($b)>0){
            die('Ledger Name already exists');
        }else{
            $c = mysqli_query($dbc,"insert into ledger_account values('$cid','$ctg','$cls','$bil','$type','$lid','$lnm','$ajaxDate','$ajaxTime','1','1','$Uname')");
            if($c){
                echo '1';
            }else{
                die($ERR);
            }
        }
    }
       
        
}

?>