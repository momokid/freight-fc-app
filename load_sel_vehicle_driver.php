<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$id =  (trim(mysqli_real_escape_string($dbc, $_POST['id'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    
    $a = mysqli_query($dbc, "SELECT * FROM truck_driver_view WHERE VehicleAssigned='$id'");

    if (mysqli_num_rows($a) > 0) {
        $an = mysqli_fetch_assoc($a);

        $options .= '<option id=' . $an['DriverID'] . ' selected>' . $an['FirstName'] . ' ' . $an['LastName'] . '</option>';
    }


    $b = mysqli_query($dbc, "SELECT * FROM truck_driver_view WHERE VehicleAssigned <> '$id' ORDER BY Brand ASC");

    while ($bn = mysqli_fetch_assoc($b)) {
        $options .= '<option id=' . $bn['DriverID'] . ' >' . $bn['FirstName'] . ' ' . $bn['LastName'] . '</option>';
    }

    echo $options;
}


