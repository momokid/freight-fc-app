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


<div class="row mt-4 ml-1">


    <div class="container mt-4">

        <!-- Card for Vehicle V001 -->
        <?php
        $b = mysqli_query($dbc, "SELECT * FROM truck_inspection_view WHERE InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ");
        if (mysqli_num_rows($b) == 0) { ?>

            <div class="container mt-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>No Vehicle Inspection Data </h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Inspection Date:</strong> NA </p>
                        <p><strong>Odometer Reading:</strong> 0.00 km</p>
                        <p><strong>Tire Condition:</strong> NA</p>
                        <p><strong>Brake Condition:</strong> NA</p>
                        <p><strong>Light Condition:</strong> NA</p>
                        <p><strong>Inspection Status:</strong> <span class="badge badge-danger">NA</span></p>
                        <p><strong>Comments:</strong> No comment</p>
                    </div>
                    <div class="card-footer">
                        <small>---</small>
                    </div>
                </div>
            </div>

            <?php } else {
            $c = mysqli_query($dbc, "SELECT DISTINCT VehicleID, VehicleName FROM truck_inspection_view WHERE InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ORDER BY VehicleName ASC");
            while ($cn = mysqli_fetch_assoc($c)) { ?>
                <div class="container mt-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="font-weight-bold text-primary"><?= $cn['VehicleName'] ?> <i class="fas fa-toolssss"></i></h5>
                        </div>
                        <?php
                        $d = mysqli_query($dbc, "SELECT * FROM truck_inspection_view WHERE  VehicleID = '$cn[VehicleID]' AND InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]' ORDER BY InspectionDate");
                        while ($dn = mysqli_fetch_assoc($d)) { ?>
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <h5><strong>Inspection ID: <?= $dn['InspectionID'] ?></strong> --- [<?= $dn['InspectionType'] ?> Inspection]</h5>
                                    <h5><strong>Inspection Date:</strong> <?= formatDate($dn['InspectionDate']) ?> </h5>
                                    <h5><strong>Inspector's Name:</strong> <?= $dn['InspectorName'] ?> </h5>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p><strong>Odometer Reading:</strong> <?= formatNumber($dn['OdometerReading']) ?> km</p>
                                        <p><strong>Tire Condition:</strong> <?= $dn['TireCondition'] ?></p>
                                        <p><strong>Brake Condition:</strong> <?= $dn['BrakeCondition'] ?></p>
                                        <p><strong>Light Condition:</strong> <?= $dn['LightsCondition'] ?></p>
                                        <p><strong>Engine Condition</strong> <?= $dn['EngineCondition'] ?></p>
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Fluid Levels:</strong> <?= $dn['FluidLevels'] ?></p>
                                        <p><strong>Body Condition:</strong> <?= $dn['BodyCondition'] ?></p>
                                        <p><strong>Brake Condition:</strong> <?= $dn['BrakeCondition'] ?></p>
                                        <p><strong>Notes:</strong> <?= $dn['AdditionalNotes'] ?></p>
                                        <p><strong>Next Inspection Date: </strong> <?= formatDate($dn['NextInspectionDate']) ?></p>
                                        <hr>
                                    </div>
                                </div>

                            </div>
                        <?php }
                        ?>

                        <?php
                        $e = mysqli_query($dbc, "SELECT Count(VehicleID) as InspectionCount FROM truck_inspection_view WHERE  VehicleID = '$cn[VehicleID]' AND InspectionDate BETWEEN '$an[FDate]' AND '$an[LDate]'");
                        while ($en = mysqli_fetch_assoc($e)) { ?>

                            <div class="card-footer">
                                <strong>Total inspection count for <?= $cn['VehicleName']?> </span>: <strong class="text-danger font-weight-bold"><?= $en['InspectionCount'] ?></span> 
                            </div>
                        <?php }
                        ?>

                    </div>
                </div>
        <?php  }
        } ?>
    </div>

</div>