<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$a = mysqli_query($dbc, "select * from graph_test_1 order by YearName,DMonth Limit 12");
$output = [];

$output = $a->fetch_all(MYSQLI_ASSOC);
$sresult = json_encode($output);

echo $sresult; 
/* while ($an = mysqli_fetch_assoc($a)) {
    $result = [
        'Date' => $an['Date'],
        'ConsginmentDetail' => [
            'Name' => $an['FullName'],
            'HBL' => $an['HouseBL'],
            'Total Fee Charged' => $an['TFee'],
        ],
        'Package' => [
            'Weight' => $an['Weight'],
            'Count' => $an['Package'],
            'Unit' => $an['Unit']
        ],
    ];
 
    echo json_encode($result);
}*/
