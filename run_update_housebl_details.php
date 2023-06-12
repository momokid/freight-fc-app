<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid=  (trim(mysqli_real_escape_string($dbc,$_POST['cid'])));
$cns=  (trim(mysqli_real_escape_string($dbc,$_POST['cn1'])));
$hbl=  (trim(mysqli_real_escape_string($dbc,$_POST['hbl'])));
$mbl=  (trim(mysqli_real_escape_string($dbc,$_POST['mbl'])));
$cns2=  trim(mysqli_real_escape_string($dbc,$_POST['cn2']));
$wgt= floatval(trim(mysqli_real_escape_string($dbc,$_POST['wgt'])));
$pkg=  trim(mysqli_real_escape_string($dbc,$_POST['pkg']));
$unit=  trim(mysqli_real_escape_string($dbc,$_POST['unt']));
$dsc=  trim(mysqli_real_escape_string($dbc,$_POST['dsc']));
$type=  trim(mysqli_real_escape_string($dbc,$_POST['itp']));
$oif=  trim(mysqli_real_escape_string($dbc,$_POST['oif']));
$vin=  trim(mysqli_real_escape_string($dbc,$_POST['vin']));

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($cns==''){
    die('Missing Cosignee ID');
}elseif($cns2==''){
    die('Missing Notify Party ID');
}elseif($hbl==''){
    die('Missing House BL');
}elseif($mbl==''){
    die('Unknown Bill of Lading');
}elseif($pkg==''){
    die('Missing Package');
}elseif($unit==''){
    die('Missing Unit');
}elseif($type ==''){
    die('Select Item Type');
}elseif($dsc==''){
    die('Missing Description');
}elseif($type=='GOODS' && $vin<>''){
    die('VIN is only for VEHICLE Item Type');
}elseif($type ==='VEHICLE' && $vin==''){
    die('Enter VIN');
}elseif($type=='VEHICLE' && strlen($vin)<17){
    die('VIN cannot be less than 17 characters');
}elseif($pkg>1 && $oif==''){
    die('Package is more than 1. You must specify Other Information');
}elseif($pkg==1 and $oif<>''){
    die('Other Information not allowed for [1] Package');
}else{
    $a = mysqli_query($dbc, "select * from manifestation_breakdown where ConsignmentID='$cid' and HouseBL='$hbl' and MainBL='$mbl'");
    if(mysqli_num_rows($a)==0){
        die('Manifest breakdown details not found');
    }else if(mysqli_num_rows($a)>1){
        die('Multiple manifest breakdown details detected for '.$hbl);
    }else{
        $b = mysqli_query($dbc, "update manifestation_breakdown set ConsigneeID='$cns',Consigenee2_ID='$cns2',Description='$dsc',ItemType='$type',VIN='$vin',OtherInfo='$oif',Package='$pkg',Unit='$unit' where ConsignmentID='$cid' and HouseBL='$hbl' and MainBL='$mbl'");
        
        if($b){
            echo '1';
        }else{
            die($CRC);
        }
    }  
       
        
}
