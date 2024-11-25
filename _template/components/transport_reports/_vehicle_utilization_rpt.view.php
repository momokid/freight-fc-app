<table class="" style="width:1200px;border: 0px solid red;margin-top: 5px;color:black;margin-left: 10px;">
    <thead>
        <tr style="font-weight:bold;" width="140">
            <td style="text-align: center;">
                <div><img src="img/logo1.png" height="100rem" /></div>
            </td>
            <td colspan="3" scope="col" style="text-align: center;">
                <div style="font-size: 15px;text-transform: uppercase;"><?= $bn['InstName']  ?></div>
                <div style="font-size: 15px;"><?= $bn['Address']  ?></div>
                <div style="font-size: 15px;"><?= $bn['Email']  ?></div>
                <div style="font-size: 15px;"><?= $bn['Location']  ?></div>
            </td>
            <td width="300;">
                <div style="margin-top:-2rem;padding:0.5rem;float:right;background:orangered;color:white;">
                    <span style="font-size: 15px;">VEHICLE UTILIZATION REPORT</span><br>
                    <span style="font-size: 15px;">BRANCH: <?= $bn['BranchName']; ?></span><br>
                    <span style="font-size: 15px;">DATE: <?= strftime("$dtf", strtotime($an['FDate'])); ?> <em>TO</em> <?= strftime("$dtf", strtotime($an['LDate'])); ?></span>
                </div>
            </td>
        </tr>
    </thead>
</table>


<?php


$b = mysqli_query($dbc, "SELECT COALESCE(truck_utilization_income.VehicleID,truck_utilization_expenditure.VehicleID) AS VehicleID, 
                                COALESCE(truck_utilization_income.VehicleName,truck_utilization_expenditure.VehicleName) AS Vehicle, 
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

?>

<div class="table-responsive mt-4 ml-1">

    <table class="table table-bordered border-primary" style="width:1200px;">
        <thead class="table-dark text-center">
            <th>VEHICLE</th>
            <th>TOTAL REVENUE</th>
            <th>TOTAL EXPENDITURE</th>
            <th>SUB PROFIT /LOSS</th>
        </thead>

        <?php if (mysqli_num_rows($b) == 0) { ?>
            <tr>
                <td colspan="4">No data found.</td>
            </tr>
            <?php } else {
            while ($bn = mysqli_fetch_assoc($b)) {
                $netIncome += $bn['total_income'];
                $netExpenditure += $bn['total_expenditure'];
                $net_profit_loss += $bn['net_profit_loss'];
            ?>
                <tr>
                    <td> <?= $bn['Vehicle'] ?></td>
                    <td> <?= formatNumber($bn['total_income']) ?></td>
                    <td> <?= formatNumber($bn['total_expenditure']) ?></td>
                    <td class="font-weight-bold"> <?= formatNumber($bn['net_profit_loss']) ?></td>
                </tr>

                <?php
                $c =  mysqli_query($dbc, "SELECT COALESCE(ROUND(MAX(OdometerReading),2),0) AS MaxOdo, COALESCE(ROUND(MIN(OdometerReading),2),0) AS MinOdo, COALESCE(COUNT(VehicleID),0) As InspectionCount FROM truck_inspection WHERE VehicleID='$bn[VehicleID]'");
                $d =  mysqli_query($dbc, "SELECT COALESCE(COUNT(VehicleID),0) AS TripCount FROM truck_trip WHERE VehicleID='$bn[VehicleID]'");

                $cn = mysqli_fetch_assoc($c);
                $dn = mysqli_fetch_assoc($d);  ?>

                <tr>
                    <td></td>
                    <td colspan="3"><span  class="badge rounded-pill text-bg-primary  p-2">NO. OF TRIP(S): <?= $dn['TripCount']?></span>  
                    <span class="badge rounded-pill text-bg-info p-2">DISTANCE COVERED: <?=$cn['MaxOdo'] - $cn['MinOdo'] ?>km</span>
                    <span class="badge rounded-pill text-bg-dark p-2"><i class="fas fa-fw fa-tachometer-alt"></i> <?= $cn['MaxOdo'] ?></span> 
                    <span class="badge rounded-pill text-bg-warning p-2">NO.OF INPSECTION: <?= $cn['InspectionCount'] ?></span></td>
                </tr>
        <?php    }
        } ?>

        <tr>
            <td class="font-weight-bold">Total Income: <?= formatNumber($netIncome); ?></td>
            <td class="font-weight-bold">Total Expenditure: <?= formatNumber($netExpenditure); ?></td>
            <td class="font-weight-bold">Net Profit /Loss: <?= formatNumber($net_profit_loss); ?></td>
            <td></td>
        </tr>
    </table>

</div>



<div class="col-6">
    <canvas id="vehicleUtilisationChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    async function fetchDataAndUpdateChart() {
        try {
            // Fetch data from PHP
            const response = await fetch('vehicle_utilization_report.chart.php');
            const data = await response.json();

            // Prepare labels and datasets
            const labels = data.map(item => item.vehicle);
             const incomeData = data.map(item => item.total_income);
            const expenditureData = data.map(item => item.total_expenditure);

            console.log(labels)
            // Create Chart
            const ctx = document.getElementById('vehicleUtilisationChart').getContext('2d');
            const vehicleUtilisationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Revenue',
                            data: incomeData,
                            backgroundColor: 'rgba(76, 175, 80, 0.7)',
                        },
                        {
                            label: 'Expenditure',
                            data: expenditureData,
                            backgroundColor: 'rgba(244, 67, 54, 0.5)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'VEHIICLE UTILIZATION REPORT'
                        }
                    }


                }
            });
        } catch (error) {
            console.error("Error fetching data: ", error);
        }
    }

    fetchDataAndUpdateChart();
</script>