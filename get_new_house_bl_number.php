<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
    $c = mysqli_query($dbc, "select * from inst_reg");
    $cn = mysqli_fetch_assoc($c);
    
    $a = mysqli_query($dbc, "select * from temp_manifestation_breakdown_view where Username='$Uname'");
    
    if(mysqli_num_rows($a)>0){
        $b = mysqli_query($dbc, "select max(HDLID) as ID,HBLNo,MainBL,HouseBL from temp_manifestation_breakdown_view where Username='$Uname'");
        $bn = mysqli_fetch_assoc($b);
        
        $no =  $bn['ID']+1;
        $nbl = substr($bn['HouseBL'],4);
        $bbl = substr($nbl,0, -1) ;
        echo $cn['Initial'].$bbl.$no;
    }else{
       
       #Search for selected container
       $b = mysqli_query($dbc, "select * from temp_mainbl_new_consignee where Username='$Uname'");
       if(mysqli_num_rows($b)==0){
           #Container/BL not selected into temp table
       }else{
           $bn = mysqli_fetch_assoc($b);
           $hbl =  substr($bn['MainBL'], -4) ;
           
           echo $cn['Initial'].$hbl.'1';
       }        
    }
    
}