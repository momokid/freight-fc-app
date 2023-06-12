<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}else{
   $a = mysqli_query($dbc, "select * from ledger_category where Status='1' and Type='GL' order by SubCategoryID");
   
   if(mysqli_num_rows($a)==0){
      echo '<option selected></option>';
   }else{
          
       echo '<option selected></option>';
       
      while($an = mysqli_fetch_assoc($a)){
          echo '<option id='.$an['SubCategoryID'].' class="'.$an['Class'].'">'.$an['SubCategoryName'].'</option>';
      } 
   }
}