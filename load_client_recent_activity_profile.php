<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else { ?>

    <table class="table table-hover table-bordered" style="padding:0px;" id="tblclientrecentinvoice">
        <thead>
            <tr class="bg-dark text-white font-weight-bold">
                <td>BL</td>
                <td>SHIPPER</td>
                <td>VESSEL</td>
                <td>ETA</td>
                <td>CONTAINER COUNT</td>
                <td>OFFICER ASSIGNED</td>
                <td>D.O.T.</td>
            </tr>
        </thead>  
        <tbody>

            <?php
            $b = mysqli_query($dbc, "SELECT * FROM container_main_view_1 WHERE ConsigneeID='$cns'");

            if (mysqli_num_rows($b) == 0) { ?>
                <tr>
                    <td colspan="6">No data found.</td>

                </tr>
                <?php } else {
                $a = mysqli_query($dbc, "SELECT BL, ShipperName, VesselName, ETA, Date, COUNT(ContainerNo) as ContainerCount, OfficerAssignedName FROM container_main_view_1 WHERE ConsigneeID='$cns' ORDER BY Time Asc; ");

                while ($an = mysqli_fetch_assoc($a)) { ?>
                    <tr class="client_profile_bl_issued" bl="<?= $an['BL'] ?>" stamp="BL" cns="<?= $cns ?>">
                        <td scope="col"><?= $an['BL'] ?></td>
                        <td scope="col"><?= $an['ShipperName'] ?></td>
                        <td scope="col"><?= $an['VesselName'] ?></td>
                        <td scope="col"><?= formatDate($an['ETA']) ?></td>
                        <td scope="col"><?= $an['ContainerCount'] ?></td>
                        <td scope="col"><?= $an['OfficerAssignedName'] ?></td>
                        <td scope="col"><?= formatDate($an['Date']) ?> <i class="fas fa-file pl-2" title="View BL"></i> <i class="fas fa-eye pl-2 text-success" title="View Transactions"></i></td>
                    </tr>
            <?php
                }
            } ?>

        <tbody>
    </table>
<?php }
?>

<style>
    .client_profile_bl_issued {
        cursor: pointer;
    }
</style>

<script>
    $('#tblclientrecentinvoice').DataTable();

    $('.client_profile_bl_issued').click(function() {
        let bl = $.trim($(this).attr('bl'));
        let cns = $.trim($(this).attr('cns'));

        $('.progress-loader').remove();

        //alert(`${cns} and ${hbl} and ${mbl}`);
        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php', {
            cid: bl,
            sid: cns
        }, function(a) {
            var win = window.open();
            win.location = "load_consignee_bl_view.php", "_blank";
            win.opener = null;
            win.blur();
            window.focus();
            $('.progress-loader').remove();
        });

        // if (stamp == 'BL') {
        //     if (type === '0.00') {
        //         $.post('insert_recno_rpt.php', {
        //             cid: rec
        //         }, function() {
        //             window.open("invoice_payment_receipt.php", "_blank");
        //         });
        //     } else {
        //         if (sid == '') {
        //             $.post('insert_recno_rpt.php', {
        //                 sid: rec
        //             }, function() {
        //                 window.open("invoice_other_services.php", "_blank");
        //             });
        //         } else {
        //             $.post('insert_recno_rpt.php', {
        //                 sid: rec
        //             }, function() {
        //                 window.open("invoice_housebl_charges.php", "_blank");
        //             });
        //         }

        //     }
        // } else if (stamp == 'BL_NONBL') {
        //     $.post('insert_recno_rpt.php', {
        //         sid: rec
        //     }, function() {
        //         window.open("invoice_other_services_non_manifest.php", "_blank");
        //     });
        // }

    });
</script>