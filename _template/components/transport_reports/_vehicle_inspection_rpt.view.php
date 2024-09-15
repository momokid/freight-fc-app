
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
                    <span style="font-size: 15px;">VEHICLE INSPECTION REPORT</span><br>
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
            <th>DRIVER</th>
            <th>INCIDENT</th>
            <th>DATE</th>
            <th>LOCATION</th>
            <th>DESCRIPTION</th>
            <th>EST. COST</th>
            <th>RESOLUTION</th>
            <th>RES. DATE</th>
        </thead>

        <?php
        $Ldate = $an['LDate'];
        $FDate = $an['FDate'];

        $z = mysqli_query($dbc, "SELECT * FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
        if (mysqli_num_rows($z) == 0) { ?>
            <tbody>
                <td colspan="9">Data not found between <span class="text-danger font-weight-bold"><?= formatDate($an['FDate']) ?></span> and <span class="text-danger font-weight-bold"><?= formatDate($an['LDate']) ?></span> </td>
            </tbody>
        <?php } else { ?>
            <tbody style="font-size: 14px;">
                <?php
                $b = mysqli_query($dbc, "SELECT DISTINCT VehicleID, VehicleDescription FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <tr>
                        <td colspan="9" class="font-weight-bold"><?= $bn['VehicleDescription']  ?></td>
                    </tr>

                    <?php
                    $c = mysqli_query($dbc, "SELECT * FROM truck_incident_view_2 WHERE  VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]'");
                    while ($cn = mysqli_fetch_assoc($c)) { ?>
                        <tr>
                            <td></td>
                            <td><?= $cn['DriverName']  ?></td>
                            <td><?= $cn['IncidentType'] ?></td>
                            <td><?= formatDate($cn['IncidentDate']) ?></td>
                            <td><?= $cn['Location']  ?></td>
                            <td><?= $cn['Description']  ?></td>
                            <td><?= formatNumber($cn['DamageEstimation'])  ?></td>
                            <td><?= $cn['ResolutionStatus'] ?></td>
                            <td><?= formatDate($cn['ResolutionDate']) ?></td>
                        </tr>
                    <?php }

                    $d = mysqli_query($dbc, "SELECT ROUND(SUM(DamageEstimation),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_incident_view_2 WHERE VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                    while ($dn = mysqli_fetch_assoc($d)) { ?>

                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="font-weight-bold">INCIDENT COUNT : <span><?= $dn['TVehicle'] ?></span></td>
                            <td colspan="3" class="font-weight-bold">SUBTOTAL : <span><?= formatNumber($dn['TotalAmt']) ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-white">.</td>
                        </tr>
                <?php }
                }
                ?>

                <?php
                $e = mysqli_query($dbc, "SELECT ROUND(SUM(DamageEstimation),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                $f = mysqli_query($dbc, "SELECT  COUNT(IncidentTypeID) as IncidentCount FROM truck_incident_view_2 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' GROUP BY VehicleID");

                $fn = mysqli_fetch_assoc($f);

                while ($en = mysqli_fetch_assoc($e)) { ?>
                    <tr class="font-weight-bold">
                        <td colspan="4">TOTAL INCIDENTS COUNT : <span><?= $en['TVehicle'] ?></span></td>
                        <td colspan="3">TOTAL DAMAGE ESTIMATED : <span><?= formatNumber($en['TotalAmt']) ?></span></td>
                        <td colspan="2" class="text-danger">PENDING INCIDENTS: <span><?= $fn['IncidentCount']?></span></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        <?php   } ?>


    </table>
</div>
