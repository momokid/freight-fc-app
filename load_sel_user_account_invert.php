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
   $a = mysqli_query($dbc, "SELECT * FROM kaina WHERE ID != '$Uname'  ORDER BY FullName ASC");
   
   if(mysqli_num_rows($a)==0){
      echo '<option selected>No User Account</option>';
   }else{
     //  $an = mysqli_fetch_assoc($a);
      // $b = mysqli_query($dbc, "select * from sub_class_subject_view where SubClassID='$an[SubClassID]'");
       
      echo '<option selected></option>';
       
      while($an = mysqli_fetch_assoc($a)){
          echo '<option id='.$an['ID'].'>'.$an['FullName'].'</option>';
      } 
   }
}