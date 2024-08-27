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
        <table class="table table-warning table-bordered">
            <thead>
                <tr>
                    <th scope="col">BRAND</th>
                    <th scope="col">MODEL</th>
                    <th scope="col">YEAR</th>
                    <th scope="col">LICENSE PLATE</th>
                    <th scope="col">VIN</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $a = mysqli_query($dbc, "SELECT * FROM truck_new");

                if (mysqli_num_rows($a) > 0) {

                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td><?= $an['Brand']  ?></td>
                            <td><?= $an['Model']  ?></td>
                            <td><?= $an['YearOfMake']  ?></td>
                            <td><?= $an['LicensePlate']  ?></td>
                            <td><?= $an['VIN']  ?></td>
                        </tr>
                <?php  }
                }
                ?>


            </tbody>
        </table>
    </div>


<?php }
