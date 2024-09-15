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
                    <span style="font-size: 15px;">VEHICLE TRIP REPORT</span><br>
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
            <th>DEPARTURE DATE</th>
            <th>RETURN DATE</th>
            <th>CARGO DETAILS</th>
            <th>PICKUP POINT</th>
            <th>DELIVERY POINT</th>
            <th>AMT PAID</th>
            <th>T. DATE</th>
        </thead>

        <?php
        $Ldate = $an['LDate'];
        $FDate = $an['FDate'];

        $z = mysqli_query($dbc, "SELECT * FROM truck_trip_view_1 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
        if (mysqli_num_rows($z) == 0) { ?>
            <tbody>
                <td colspan="9">Data not found between <span class="text-danger font-weight-bold"><?= formatDate($an['FDate']) ?></span> and <span class="text-danger font-weight-bold"><?= formatDate($an['LDate']) ?></span> </td>
            </tbody>
        <?php } else { ?>
            <tbody style="font-size: 14px;">
                <?php
                $b = mysqli_query($dbc, "SELECT DISTINCT VehicleID, VehicleDescription FROM truck_trip_view_1 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <tr>
                        <td colspan="9" class="font-weight-bold"><?= $bn['VehicleDescription']  ?></td>
                    </tr>

                    <?php
                    $c = mysqli_query($dbc, "SELECT * FROM truck_trip_view_1 WHERE  VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]'");
                    while ($cn = mysqli_fetch_assoc($c)) { ?>
                        <tr>
                            <td></td>
                            <td><?= $cn['FullName']  ?></td>
                            <td><?= formatDate($cn['DepartureTime']) ?></td>
                            <td><?= formatDate($cn['ReturnDate']) ?></td>
                            <td><?= $cn['CargoDetails']  ?></td>
                            <td><?= $cn['PickupPoint']  ?></td>
                            <td><?= $cn['DeliveryPoint']  ?></td>
                            <td><?= formatNumber($cn['AmountPaid']) ?></td>
                            <td><?= formatDate($cn['Date']) ?></td>
                        </tr>
                    <?php }

                    $d = mysqli_query($dbc, "SELECT ROUND(SUM(AmountPaid),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_trip_view_1 WHERE VehicleID = '$bn[VehicleID]' AND Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                    while ($dn = mysqli_fetch_assoc($d)) { ?>

                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2" class="font-weight-bold">TRIP COUNT : <span><?= $dn['TVehicle'] ?></span></td>
                            <td colspan="3" class="font-weight-bold">SUBTOTAL : <span><?= formatNumber($dn['TotalAmt']) ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-white">.</td>
                        </tr>
                <?php }
                }
                ?>

                <?php
                $e = mysqli_query($dbc, "SELECT ROUND(SUM(AmountPaid),2) AS TotalAmt, COUNT(VehicleID) as TVehicle FROM truck_trip_view_1 WHERE Date BETWEEN '$an[FDate]' AND '$an[LDate]' ");
                while ($en = mysqli_fetch_assoc($e)) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2" class="font-weight-bold">TOTAL TRIPS : <span><?= $en['TVehicle'] ?></span></td>
                        <td colspan="3" class="font-weight-bold">TOTAL AMOUNT : <span><?= formatNumber($en['TotalAmt']) ?></span></td>
                        <td colspan="2"></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        <?php   } ?>


    </table>
</div>