<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$consignee=  (trim(mysqli_real_escape_string($dbc,$_POST['consignee_name'])));
$qty=  (trim(mysqli_real_escape_string($dbc,$_POST['qty'])));
$vehicle_no=  trim(mysqli_real_escape_string($dbc,$_POST['vehicle_no']));
$driver_name=  trim(mysqli_real_escape_string($dbc,$_POST['driver_name']));
$port=  trim(mysqli_real_escape_string($dbc,$_POST['port']));
$driver_license=  trim(mysqli_real_escape_string($dbc,$_POST['driver_license']));
$package=  trim(mysqli_real_escape_string($dbc,$_POST['package']));
$description=  trim(mysqli_real_escape_string($dbc,$_POST['description']));
$date=  trim(mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['date']))));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($consignee==''){
    echo json_encode(array('code'=>300,"msg"=>"Enter Consignee Name"));
}elseif($vehicle_no==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Vehicle No."));
}elseif($driver_name==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Driver's Name"));
}elseif($port==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Port"));
}elseif($driver_license==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Driver's License"));
}elseif($package==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Package"));
}elseif($description==''){
    echo json_encode(array("code"=>300,"msg"=>"Enter Description"));
}elseif($qty<=0){
    echo json_encode(array("code"=>300,"msg"=>"Enter Quantity"));
}else{
   $a = mysqli_query($dbc,"INSERT INTO waybill_main VALUES('','$consignee','$vehicle_no','$driver_name','$port','$driver_license','$package','$description','$qty','$date','$Uname','$ajaxDate','$ajaxTime')");

   if($a){
       $b = mysqli_query($dbc,"select max(id) as ID from waybill_main");
       if(mysqli_num_rows($b)==1){
           $bn = mysqli_fetch_assoc($b);
           $c = mysqli_query($dbc,"delete from rpt_multi_values_0 where Username='$Uname'");
           $d = $dbc->query("insert  rpt_multi_values_0 values('','','$bn[ID]','','','$Uname','$ajaxTime')");

           echo json_encode(array("code"=>200,"msg"=>"Waybill saved successfully"));
       }else{
           echo json_encode(array("code"=>300,"msg"=>"Error detected."));
       }

   }else{
       die($CRC);
   }
}
