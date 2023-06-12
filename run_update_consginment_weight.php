<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$bl =  (trim(mysqli_real_escape_string($dbc, $_POST['bl'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} elseif ($bl == '') {
    die('Missing Main BL');
} else {

    $b = mysqli_query($dbc, "select * from consignment_weight_temp where MainBL='$bl' and Username='$Uname'");
    if (mysqli_num_rows($b) == 0) {
        die('Consignment details not selected');
    } else {
        $a = mysqli_query($dbc, "select * from consignment_weight_temp_view where MainBL='$bl' and Username='$Uname'");
        $an  = mysqli_fetch_assoc($a);


        $dbc->autocommit((FALSE));

        $d = mysqli_query($dbc, "update container_main set ContWeight='$an[Total]' where BL='$bl'");
        $e = mysqli_query($dbc, "update container_details set Weight='$an[Total]' where BL='$bl'");
        
        while ($bn = mysqli_fetch_assoc($b)) {
            $c = mysqli_query($dbc, "update manifestation_breakdown set Weight='$bn[Weight]' where HouseBL='$bn[HBL]' and MainBL='$bn[MainBL]' and ConsignmentID='$bn[ConsignmentID]'");
        }

        if ($c and $d and $e) {
            $dbc->commit();
            echo '1';
        } else {
            die($CRC);
        }
    }
}
