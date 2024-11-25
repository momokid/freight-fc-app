<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

header('Content-Type: application/json');


$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values_0 WHERE Username='$Uname'");
    $an = mysqli_fetch_assoc($a);

    $stmt = mysqli_query($dbc, "SELECT VehicleName AS vehicle, ROUND(SUM(Amount),2) AS expenditure FROM truck_expense_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' GROUP BY VehicleID");
    $data = array();

    while ($row = $stmt->fetch_assoc()) {
        $data[] = $row; // Add each row to the array
    }

    // Return JSON response
    echo json_encode($data);

}
