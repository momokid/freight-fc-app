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
   $a = mysqli_query($dbc, "SELECT * FROM truck_driver_view ORDER BY FullName");
   
   if(mysqli_num_rows($a)==0){
      echo '<option selected></option>';
   }else{

       echo '<option selected></option>';
       
      while($an = mysqli_fetch_assoc($a)){ 
        echo '<option id='.$an['DriverID'].'>'.$an['FullName'].' '.$an['Model'].' '.$an['YearOfMake'].' ~ '.$an['LicensePlate'].'</option>';
    } 
   }
}