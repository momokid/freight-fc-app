<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

// Function to check for new data
function checkForNewData($pdo) {
    $stmt = $pdo->query("SELECT BL, AccountID, AccountName FROM  disbursement_analysis_view_3 WHERE ConsignmentStatus='1'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : [];
}

$currentData = checkForNewData($pdo);

$lastData = null;

// Simulate data to be sent
$data = [
    'status_code' => 200,
    'message' => 'Ok',
    'data_rows'=>$currentData
];

// Send data as JSON
echo "data: " . json_encode($data) . "\n\n";

// Flush the output buffer to ensure data is sent to the client
ob_flush();
flush();

// Optionally, you can send more data after a delay
sleep(2); // Sleep for 5 seconds before sending more data

?>