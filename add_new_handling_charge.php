<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['cid'])));
$cnm=  trim(mysqli_real_escape_string($dbc,$_POST['cnm']));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($cid==''){
    die('Missing Account Name');
}elseif($amt==''){
    die('Missing Amount');
}else{
    
    $a = $dbc->query("select * from handling_charge where AccountNo='$cid'");
    
    if(mysqli_num_rows($a)>0){
        die('Account already added');
    }else{
        $c = mysqli_query($dbc, "select * from handling_charge");
        
        if(mysqli_num_rows($c)==0){
            $N = 11;
            
            $b = mysqli_query($dbc,"insert into handling_charge values('$cid','$amt','$N','$Uname','$ajaxTime')");
            if($b){
                echo '1';
            }else{
                die($ERR);
            }
        }else{
            $d= mysqli_query($dbc, "select max(POrder) as NT from handling_charge");
            $dn = mysqli_fetch_assoc($d);
            $N = $dn['NT']+1;
            
            $b = mysqli_query($dbc,"insert into handling_charge values('$cid','$amt','$N','$Uname','$ajaxTime')");
            if($b){
                echo '1';
            }else{
                die($ERR);
            }
        }
        
    }
    
        
}

?>