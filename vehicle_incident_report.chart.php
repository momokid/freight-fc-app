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

    // Fetch incident data
    // $stmt = $pdo->prepare("SELECT IncidentType as incident_type, COUNT(*) as count FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' GROUP BY IncidentType");
    // $stmt->execute();
    // $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = mysqli_query($dbc, "SELECT IncidentType as incident_type, COUNT(*) as count FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' GROUP BY IncidentType");
    $incidents = array();

    while ($row = $stmt->fetch_assoc()) {
        $incidents[] = $row; // Add each row to the array
    }

    // Return JSON response
    echo json_encode($incidents);

}
