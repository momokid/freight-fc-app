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
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">FULL NAME</th>
                    <th scope="col">LICENSE ID</th>
                    <th scope="col">TELEPHONE #</th>
                    <th scope="col">EMPLOYMENT DATE</th>
                    <th scope="col">VEHICLE ASSIGNED</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = mysqli_query($dbc, "SELECT * FROM truck_driver_view");

                if (mysqli_num_rows($a) > 0) {

                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td><?= $an['FirstName']." ".$an['LastName']  ?></td>
                            <td><?= $an['LicenseID']  ?></td>
                            <td><?= $an['PhoneNo']  ?></td>
                            <td><?= formatDate($an['EmploymentDate'])  ?></td>
                            <td><?= $an['Brand']." ".$an['Model']." ".$an['YearOfMake']." [".$an['LicensePlate']."]"  ?></td>
                        </tr>
                <?php  }
                }
                ?>


            </tbody>
        </table>
    </div>


<?php }
