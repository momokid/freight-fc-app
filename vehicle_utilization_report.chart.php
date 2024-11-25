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

    $stmt = mysqli_query($dbc, "SELECT COALESCE(truck_utilization_income.VehicleID,truck_utilization_expenditure.VehicleID) AS VehicleID, 
                                COALESCE(truck_utilization_income.VehicleName,truck_utilization_expenditure.VehicleName) AS vehicle, 
                                COALESCE(SUM(truck_utilization_income.AmountPaid), 0) AS total_income,
                                COALESCE(SUM(truck_utilization_expenditure.Amount), 0) AS total_expenditure,
                                (COALESCE(SUM(truck_utilization_income.AmountPaid), 0) - COALESCE(SUM(truck_utilization_expenditure.Amount), 0)) AS net_profit_loss
                                    FROM (
                                        SELECT truck_utilization_income.VehicleID,truck_utilization_income.VehicleName FROM truck_utilization_income
                                        UNION
                                        SELECT truck_utilization_expenditure.VehicleID,truck_utilization_expenditure.VehicleName FROM truck_utilization_expenditure
                                    ) AS all_vehicles
                                    LEFT JOIN truck_utilization_income ON all_vehicles.VehicleID = truck_utilization_income.VehicleID
                                    AND truck_utilization_income.DepartureTime BETWEEN '$an[FDate]' AND '$an[LDate]'
                                    LEFT JOIN truck_utilization_expenditure ON all_vehicles.VehicleID = truck_utilization_expenditure.VehicleID 
                                    AND truck_utilization_expenditure.Date BETWEEN '$an[FDate]' AND '$an[LDate]'
                                    GROUP BY truck_utilization_income.VehicleID
                                    ORDER BY truck_utilization_expenditure.VehicleID");
    $data = array();

    while ($row = $stmt->fetch_assoc()) {
        $data[] = $row; // Add each row to the array
    }

    // Return JSON response
    echo json_encode($data);
}
