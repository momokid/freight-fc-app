<?php $d = mysqli_query($dbc, "SELECT * FROM pnl_transaction_general WHERE (Date BETWEEN '$an[FDate]' and '$an[LDate]')");
$dn = mysqli_fetch_assoc($d);

?>
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
                    <span style="font-size: 15px;">VEHICLE INCIDENT REPORT</span><br>
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
            <th>INSPECTION DATE</th>
            <th>INSPECTION TYPE</th>
            <th>INSPECTOR NAME</th>
            <th>ODOMETER READING</th>
            <th>NEXT INSPECTION</th>
        </thead>

        <?php

        $z = mysqli_query($dbc, "SELECT * FROM truck_inspection_view WHERE InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ");
        if (mysqli_num_rows($z) == 0) { ?>
            <tbody>
                <td colspan="9">Data not found between <span class="text-danger font-weight-bold"><?= formatDate($an['FDate']) ?></span> and <span class="text-danger font-weight-bold"><?= formatDate($an['LDate']) ?></span> </td>
            </tbody>
        <?php } else { ?>
            <tbody style="font-size: 14px;">
                <?php
                $b = mysqli_query($dbc, "SELECT DISTINCT VehicleID, VehicleName FROM truck_inspection_view WHERE InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <tr>
                        <td colspan="9" class="font-weight-bold"><?= $bn['VehicleName']  ?></td>
                    </tr>

                    <?php
                    $c = mysqli_query($dbc, "SELECT * FROM truck_inspection_view WHERE  VehicleID = '$bn[VehicleID]' AND InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ORDER BY InspectionDate ASC");
                    while ($cn = mysqli_fetch_assoc($c)) { ?>
                        <tr>
                            <td>

                            </td>
                            <td><?= formatDate($cn['InspectionDate']) ?></td>
                            <td><?= $cn['InspectionType']  ?></td>
                            <td><?= $cn['InspectorName'] ?></td>
                            <td><?= formatNumber($cn['OdometerReading']) ?></td>
                            <td><?= formatDate($cn['NextInspectionDate']) ?></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php $id = rand(0, 100); ?>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#<?= $id ?>" role="button" aria-expanded="false" aria-controls="<?= $bn['VehicleID'] ?>collapseExample">
                                    Expand details
                                </a>
                                <div class="" id="<?= $id ?>">
                                    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                </div>
                            </td>
                        </tr>
                <?php }
                }
                ?>

                <?php

                ?>
            </tbody>
        <?php   } ?>


    </table>
</div>