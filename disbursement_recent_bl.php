<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$results = [];

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else{
    $a = mysqli_query($dbc,"SELECT * FROM disbursement_temp_analysis WHERE Username='$Uname'");

    if(mysqli_num_rows($a) == 0){
        echo '<label class="mt-2 mark h6">No Recent BL</label>';
    }else{
        $an = mysqli_fetch_assoc($a);

        echo "<label class='mt-2 mark h6 '>RECENT BL: <b>{$an["BL"]} #{$an["ContainerNo"]}</b></label>";
    }
}