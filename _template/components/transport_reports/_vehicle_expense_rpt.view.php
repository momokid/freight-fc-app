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
                    <span style="font-size: 15px;">VEHICLE EXPENDITURE REPORT</span><br>
                    <span style="font-size: 15px;">BRANCH: <?= $bn['BranchName']; ?></span><br>
                    <span style="font-size: 15px;">DATE: <?= strftime("$dtf", strtotime($an['FDate'])); ?> <em>TO</em> <?= strftime("$dtf", strtotime($an['LDate'])); ?></span>
                </div>
            </td>
        </tr>
    </thead>
</table>


<div class="table-responsive mt-4 ml-1">
    <table class="table table-bordered border-primary" style="width:1200px;">
        <thead>
            <th>VEHICLE</th>
            <th>EXPENSE TYPE</th>
            <th>AMOUNT</th>
            <th>VENDOR</th>
            <th>DESCRIPTION</th>
            <th>RECIEPT #</th>
            <th>DATE</th>
        </thead>

        <?php
        $Ldate = $an['LDate'];
        $FDate = $an['FDate'];

        $z = mysqli_query($dbc, "SELECT * FROM truck_expense_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
        if (mysqli_num_rows($z) == 0) { ?>
            <tbody>
                <td colspan="9">Data not found between <span class="text-danger font-weight-bold"><?= formatDate($an['FDate']) ?></span> and <span class="text-danger font-weight-bold"><?= formatDate($an['LDate']) ?></span> </td>
            </tbody>
        <?php } else { ?>
            <tbody style="font-size: 14px;">
                <?php
                $b = mysqli_query($dbc, "SELECT DISTINCT VehicleID, VehicleName FROM truck_expense_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <tr>
                        <td colspan="9" class="font-weight-bold"><?= $bn['VehicleName']  ?></td>
                    </tr>

                    <?php
                    $c = mysqli_query($dbc, "SELECT * FROM truck_expense_view_2 WHERE  VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]'");
                    while ($cn = mysqli_fetch_assoc($c)) { ?>
                        <tr>
                            <td></td>
                            <td><?= $cn['ExpenseType']  ?></td>
                            <td><?= formatNumber($cn['Amount'])  ?></td>
                            <td><?= $cn['Vendor']  ?></td>
                            <td><?= $cn['Description']  ?></td>
                            <td><?= $cn['ReceiptNo'] ?></td>
                            <td><?= formatDate($cn['Date']) ?></td>
                        </tr>
                    <?php }

                    $d = mysqli_query($dbc, "SELECT ROUND(SUM(Amount),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_expense_view_2 WHERE VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                    while ($dn = mysqli_fetch_assoc($d)) { ?>

                        <tr>
                            <td colspan="4"></td>
                            <td colspan="3" class="font-weight-bold">SUBTOTAL : <span class="text-danger"><?= formatNumber($dn['TotalAmt']) ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-white">.</td>
                        </tr>
                <?php }
                }
                ?>

                <?php
                $e = mysqli_query($dbc, "SELECT ROUND(SUM(Amount),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_expense_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                $f = mysqli_query($dbc, "SELECT  COUNT(ExpenseTypeID) as IncidentCount FROM truck_expense_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' GROUP BY VehicleID");

                $fn = mysqli_fetch_assoc($f);

                while ($en = mysqli_fetch_assoc($e)) { ?>
                    <tr class="font-weight-bold">
                        <td colspan="7">TOTAL EXPENDITURE : <span class="text-danger"><?= formatNumber($en['TotalAmt']) ?></span></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        <?php   } ?>


    </table>
</div>

<div class="col-6">
    <canvas id="vehicleExpenseChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    async function fetchDataAndUpdateChart() {
        try {
            // Fetch data from PHP
            const response = await fetch('vehicle_expenditure_report.chart.php');
            const data = await response.json();

            // Prepare labels and datasets
            const labels = data.map(item => item.vehicle);
            // const incomeData = data.map(item => item.income);
            const expenditureData = data.map(item => item.expenditure);

            console.log(labels)
            // Create Chart
            const ctx = document.getElementById('vehicleExpenseChart').getContext('2d');
            const vehicleExpenseChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        // {
                        //     label: 'Income',
                        //     data: incomeData,
                        //     backgroundColor: 'rgba(76, 175, 80, 0.7)',
                        // },
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
                            text: 'VEHIICLE EXPENDITURE REPORT'
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