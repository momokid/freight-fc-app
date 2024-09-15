<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$fdt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_GET['fdt'])));
$ldt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_GET['ldt'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else { ?>

    <table class="table table-bordered table-responsive" style="padding:0px;" id="DisbursementProcessView">
        <thead class="thead-lig">
            <tr>
                <th scope="col">VEHICLE</th>
                <th scope="col">LICENSE PLATE</th>
                <th scope="col">DRIVER</th>
                <th scope="col">TRIP</th>
                <th scope="col">INSPECTION</th>
                <th scope="col">INCIDENT</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $a = mysqli_query($dbc, "SELECT * FROM truck_inventory_overview_4 ORDER BY VehicleDescription");
            if (mysqli_num_rows($a) > 0) {

                while ($an = mysqli_fetch_assoc($a)) {
                    $subNetIncome = $an['TotalCashReceipt'] - $an['TExpenditure'];
            ?>

                    <tr data-toggle="modal" id="<?= $an['VehicleID'] ?>" data-target="#viewDisbursementDetails" class="viewVehicleInventoryList">
                        <td scope="col"><?= $an['VehicleDescription'] ?></td>
                        <td scope="col"><?= $an['LicensePlate'] ?></td>
                        <td scope="col"><?= $an['DriverFullName'] ?></td>
                        <td scope="col"><?= $an['TripCount'] ?></td>
                        <td scope="col"><?= $an['InspectionCount'] ?></td>
                        <td scope="col"><?= $an['IncidentCount'] ?></td>
                        <td scope="col" data-status="<?= $an['Status'] ?>"><?= $an['StatusTitle'] ?></td>
                        
                    </tr>
                <?php }

                
            } else { ?>

                <tr>
                    <td scope='col' colspan="7" class="font-weight-bold text-danger">No Vehicle Inventory List Found</td>
                </tr>
            <?php } ?>

        </tbody>

        <tr>
            <td colspan="7">
            <form class="col-sm-12 mb-3 user">
                <button type="button" class="btn btn-success btn-user btn-block" id="btn_vehicle_inventory_rpt">
                  View Vehicle List
            </button>
              </form>
            </td>
        </tr>
    </table>
<?php }

?>

<style>
    .thead-lig {
        background: green;
        color: white;
    }

    .viewVehicleInventoryList:hover {
        background: #bbb;
        color: white;
        /* cursor: pointer; */
    }
</style>

<script>
    //$('#DisbursementProcessView').DataTable();

    $('.viewVehicleInventoryList').click(function() {
        let id = $.trim($(this).attr('id'));

        if (id == '') {
            alert('Declaration No. not found');
            return false;
        } else {
            $('body').append(
                '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
            );

            $.post('insert_recno_rpt.php', {
                sid: id
            }, function() {
                $(".progress-loader").remove();
                window.open("disbursement_analysis_details.view.php", "_blank");
            });
        }
    });
</script>