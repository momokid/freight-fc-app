<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

//  

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else { ?>

    <div class="table-responsive">
        <table class="table table-secondary table-bordered table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">VEHICLE</th>
                    <th scope="col">DRIVER</th>
                    <th scope="col">CARGO DETAILS</th>
                    <th scope="col">PICKUP</th>
                    <th scope="col">DESTINATION</th>
                    <th scope="col">RETURN DATE</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $a = mysqli_query($dbc, "SELECT * FROM truck_trip_view_1 ORDER BY ReturnDate LIMIT 5");

                if (mysqli_num_rows($a) > 0) {

                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td><?= $an['VehicleDescription']  ?></td>
                            <td><?= ($an['FullName'])  ?></td>
                            <td><?= $an['CargoDetails']  ?></td>
                            <td><?= $an['PickupPoint']  ?></td>
                            <td><?= ($an['DeliveryPoint'])  ?></td>
                            <td><?=formatDate($an['ReturnDate'])  ?></td>
                        </tr>
                <?php  }
                }
                ?>


            </tbody>
        </table>
    </div>


<?php }
