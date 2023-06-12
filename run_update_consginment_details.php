<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$shpid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['shp'])));
$cid=  intval(trim(mysqli_real_escape_string($dbc,$_POST['cid'])));
$vessel=  trim(mysqli_real_escape_string($dbc,$_POST['vsl']));
$eta=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['eta']))));
$dois=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dis']))));
$sob=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['sob']))));
$pois=  trim(mysqli_real_escape_string($dbc,$_POST['pis']));
$bl=  trim(mysqli_real_escape_string($dbc,$_POST['mbl']));
$ble=  trim(mysqli_real_escape_string($dbc,$_POST['ble']));
$cntNo=  trim(mysqli_real_escape_string($dbc,$_POST['cnt']));
$sealNo=  trim(mysqli_real_escape_string($dbc,$_POST['sln']));
$cntSize=  trim(mysqli_real_escape_string($dbc,$_POST['csz']));
$polid=  trim(mysqli_real_escape_string($dbc,$_POST['pol']));
$podid=  trim(mysqli_real_escape_string($dbc,$_POST['pod']));
$carid=  trim(mysqli_real_escape_string($dbc,$_POST['car']));
$rtt=  trim(mysqli_real_escape_string($dbc,$_POST['rtn']));
$vyg=  trim(mysqli_real_escape_string($dbc,$_POST['vyg']));
$wgt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['gwt'])));
$cost=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['hct'])));

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}elseif($shpid==''){
    die('Missing Shipper Details');
}elseif($cid==''){
    die('Missing Congsinment ID');
}elseif($vessel==''){
    die('Missing Vessel Name');
}elseif($vyg==''){
    die('Enter Voyage No.');
}elseif($eta ==''){
    die('Missing ETA');
}elseif($bl==''){
    die('Missing Bill of Laden');
}elseif($sealNo==''){
    die('Missing Seal No');
}elseif($cntNo==''){
    die('Mssing Container No.');
}elseif($cntSize==''){
    die('Missing Container Size');
}elseif($dois==''){
    die('Select Date of Issue');
}elseif($pois == ''){
    die('Enter Place of Issue');
}elseif($sob ==''){
    die('Select Shipped on Board [Date]');
}elseif($polid==''){
    die('Missing P.O.L.');
}elseif($podid==''){
    die('Missing P.O.D.');
}elseif($wgt==''){
    die('Missing Gross Weight');
}elseif($carid==''){
    die('Select Shipping Line');
}elseif($cost=='' || $cost<=0){
    die('Enter Estimated Handling Cost');
}elseif($rtt ==''){
    die('Enter Rotation No.');
}elseif($ble==''){
    die('Missing BLs');
}else{
    
        $b = mysqli_query($dbc, "select * from container_main where ConsignmentID='$cid' and BL='$bl'");
        if(mysqli_num_rows($b)<>1){
            die('Consignment details not found');
        }else{
            $d = mysqli_query($dbc, "select * from container_main where BL='$bl'");
            if(mysqli_num_rows($d)<>1){
                die('Multiple records detected with the same BL');
            }else{
            
            $dbc->autocommit(FALSE);
                
              $c = mysqli_query($dbc,"update container_main set CarrierID='$carid',Rotation='$rtt',ShipperID='$shpid',VesselName='$vessel',VoyageNo='$vyg',SealNo='$sealNo',ETA='$eta',BL='$ble',ContainerNo='$cntNo',ContainerSize='$cntSize',POIS='$pois',DOIS='$dois',SOB='$sob',POL_ID='$polid',POD_ID='$podid',ContWeight='$wgt',Charges='$cost',Time='$ajaxTime' where ConsignmentID='$cid'");
              $a = mysqli_query($dbc, "update manifestation_breakdown set MainBL='$ble' where ConsignmentID='$cid'");  
              if($c and $a){
                  $dbc->commit();
                    echo '1';
                }else{
                    die($ERR);
                }  
            }
            
        }
        
        
}

?>