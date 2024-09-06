<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");


$a = mysqli_query($dbc,"SELECT count(*) as containerCount FROM disbursement_analysis_unauth_0");
$an = mysqli_fetch_assoc($a);


// Simulate data to be sent
$data = [
    'status_code' => 200,
    'message' => 'Ok',
    'containerCount'=>$an['containerCount']
];

// Send data as JSON
echo "data: " . json_encode($data) . "\n\n";

// Flush the output buffer to ensure data is sent to the client
flush();

// Optionally, you can send more data after a delay
sleep(5); // Sleep for 5 seconds before sending more data

?>