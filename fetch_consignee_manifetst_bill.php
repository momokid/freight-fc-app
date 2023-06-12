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
   $b = mysqli_query($dbc, "select * from  rpt_multi_values_0 where Username='$Uname'");
   if(mysqli_num_rows($b)==0){
        echo '<option selected>Not found</option>';
   }else{
        $bn = mysqli_fetch_assoc($b);
        
        $a = mysqli_query($dbc, "select * from manifestation_breakdown where ConsigneeID='$bn[Value1]'");

        if(mysqli_num_rows($a)==0){
            echo '<option selected>No Records Found</option>';
         }else{
      
             echo '<option selected></option>';
             
            while($an = mysqli_fetch_assoc($a)){
                echo '<option hbl="'.$an['HouseBL'].'" desc="'.$an['Description'].'" mbl='.$an['MainBL'].'>'.$an['HouseBL'].'</option>';
            } 
         }
   }
   
   
}