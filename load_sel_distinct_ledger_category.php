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
    $b = mysqli_query($dbc, "select * from rpt_multi_values_0 where Username='$Uname'");
    if (mysqli_num_rows($b) == 0) {
        echo '<option selected></option>';
    } else {
        $bn  = mysqli_fetch_assoc($b);

        $a = mysqli_query($dbc, "select * from ledger_category where Type='$bn[Value1]' order by SubCategoryName");

        if (mysqli_num_rows($a) == 0) {
            echo '<option selected></option>';
        } else {
            //  $an = mysqli_fetch_assoc($a);
            // $b = mysqli_query($dbc, "select * from sub_class_subject_view where SubClassID='$an[SubClassID]'");

            echo '<option selected></option>';

            while ($an = mysqli_fetch_assoc($a)) {
                echo '<option id="' . $an['SubCategoryID'] . '"  class="' . $an['Class'] . '">' . $an['SubCategoryName'] . '</option>';
            }
        }
    }
}
