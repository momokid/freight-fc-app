<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cnm= mysqli_real_escape_string($dbc, $_POST['cnm']);
$cid= mysqli_real_escape_string($dbc, $_POST['cid']);
$snm= mysqli_real_escape_string($dbc, $_POST['snm']);
$sid= mysqli_real_escape_string($dbc, $_POST['sid']);
$dt= mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_POST['dt'])));
$ldt= mysqli_real_escape_string($dbc, $_POST['ldt']);

if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}else{
   $a = mysqli_query($dbc, "select * from  rpt_multi_values where Username='$Uname' or SubjectID='$sid'");
   
   if(mysqli_num_rows($a)==0){
       $dbc->autocommit(FALSE);
       $b = $dbc->query("insert into rpt_multi_values values('$dt','$ldt','$cid','$sid','$Uname','$ajaxTime')");
       
       if($b){
           $dbc->commit();
           echo '1';
       }
   }else{
       $dbc->autocommit(FALSE);
       $c= $dbc->query("delete from  rpt_multi_values where Username='$Uname' or SubjectID='$sid'");
       $b = $dbc->query("insert into rpt_multi_values values('$dt','$ldt','$cid','$sid','$Uname','$ajaxTime')");
       
       if($c and $b){
           $dbc->commit();
           echo '1';
       }
   }
}