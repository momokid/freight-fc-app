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
} else { ?>

    <div class="table-responsive">
        <table class="table table-danger table-bordered table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">VEHICLE</th>
                    <th scope="col">INSPECTION DATE</th>
                    <th scope="col">INSPECTION TYPE</th>
                    <th scope="col">ODOMETER</th>
                    <th scope="col">NEXT INSPECTION DATE</th>
                    <th scope="col">INSPSECTOR NAME</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = mysqli_query($dbc, "SELECT * FROM truck_inspection_view");

                if (mysqli_num_rows($a) > 0) {

                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td><?= $an['VehicleName']  ?></td>
                            <td><?= formatDate($an['InspectionDate'])  ?></td>
                            <td><?= $an['InspectionType']  ?></td>
                            <td><?= $an['OdometerReading']  ?></td>
                            <td><?= formatDate($an['NextInspectionDate'])  ?></td>
                            <td><?= $an['InspectorName']  ?></td>
                        </tr>
                <?php  }
                }
                ?>


            </tbody>
        </table>
    </div>


<?php }
