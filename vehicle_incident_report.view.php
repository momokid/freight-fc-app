<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values_0 WHERE Username='$Uname'");
    $b = mysqli_query($dbc, "SELECT * FROM inst_branch_view WHERE BranchID='$BranchID'");

    if (mysqli_num_rows($b) == 0) {
        die('Error detected: Report not genarated.');
    } else {
        $bn = mysqli_fetch_assoc($b);

        if (mysqli_num_rows($a) == 0) {
            die('Records not found');
        } elseif (mysqli_num_rows($a) <> 1) {
            die('Multiple records detected');
        } else {
            $an = mysqli_fetch_assoc($a);
        }
    }
}


?>

<!doctype html>

<html>

<head>
    <title>VEHICLE INCIDENT REPORT</title>
    <?php
    include 'script.php';
    ?>
    <script type="text/javascript" src="js/demo/googleCharts.js"></script>
</head>

<body style="border: 0px solid green;">

    <?php
    include_once("_template/components/transport_reports/_vehicle_incident_rpt.view.php");
    ?>

    <div id="myChart"></div>

    <div style="height: 0px;" class="m-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="PRINT VIEW">
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    //     // Load the Visualization API and the corechart package.
    //     google.charts.load('current', {
    //         'packages': ['corechart']
    //     });

    //     // Set a callback to run when the Google Visualization API is loaded.
    //     google.charts.setOnLoadCallback(drawChart);

    //     // Callback that creates and populates a data table, instantiates the pie chart, passes in the data and draws it.
    //     function drawChart() {

    //         // Create the data table.
    //         var incidentData = new google.visualization.DataTable();

    //         incidentData.addColumn('string', 'Incident');
    //         incidentData.addColumn('number', 'Count');

    //         fetch('vehicle_incident_report.chart.php').then(response => response.json())
    //             .then(data => {
    //                 // let res = JSON.parse(data);
    //                 // console.log(data);

    //                 var keyValuePairs = [];

    //                 data.forEach(item => {

    //                     const key = String(item.incident_type); // Use incident_type as key
    //                     const value = Number(item.count);

    //                     keyValuePairs.push([key, value]);
    //                 });

    //                 console.log(keyValuePairs);
    //                 incidentData.addRows([keyValuePairs]);

    //                 // keyValuePairs.forEach(incident => {
    //                 //     incidentData.addRows(incident)
    //                 //     console.log("Showuiing inceing")
    //                 //     console.log(incident)
    //                 // })
    //             });


    //         // data.addRows([
    //         //     ['Man Diesel TGX 2022', 3],
    //         //     ['Toyota Hace 2018 ', 1]
    //         // ]);

    //         // Set chart options
    //         var options = {
    //             'title': 'Incident Report by Type',
    //             'width': 600,
    //             'height': 400
    //         };

    //         //Instantiate and draw our chart, passing in some options.
    //         var chart = new google.visualization.ColumnChart(document.getElementById('incident_chart'));
    //         chart.draw(incidentData, options);
    //     }
</script>

</html>
<style>
    @media print {
        @page {
            size: landscape
        }
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>