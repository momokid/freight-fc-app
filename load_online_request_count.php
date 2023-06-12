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
    $a = mysqli_query($dbc,"SELECT * FROM e_online_request");

    if(mysqli_num_rows($a)==0){
        echo '0';
    }else{
        $b =mysqli_query($dbc,"SELECT count(HouseBL) as CM FROM e_payment_confirmation_view");
        $bn = mysqli_fetch_assoc($b);

        echo $bn['CM'];
    }
}

?>