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
} else {
    $a = mysqli_query($dbc, "SELECT * FROM  container_main_view_1 WHERE BL='$cns'"); ?>

    <table class="table responsive table-bordered" style="padding:0px;">
        <thead class="bg-dark text-white text-center font-weight-bold">
            <tr>
                <td scope="col">BL#</td>
                <td scope="col">CONTAINER NO.</td>
                <td scope="col">CONSIGNEE</td>
                <td scope="col">SHIPPER</td>
                <td scope="col">VESSEL</td>
                <td scope="col">SEAL NO</td>
                <td scope="col">D.O.T.</td>
            </tr>
        </thead>

    <?php if (mysqli_num_rows($a) == 0) {
    } else {
        while ($an = mysqli_fetch_assoc($a)) {
            echo '<tbody>
                    <tr>
                        <td scope="col">' . $an['BL'] . '</td>
                        <td scope="col">' . $an['ContainerNo'] . '</td>
                        <td scope="col">' . $an['ConsigneeName'] . '</td>
                        <td scope="col">' . $an['ShipperName'] . '</td>
                        <td scope="col">' . $an['VesselName'] . '</td>
                        <td scope="col">' . $an['SealNo'] . '</td>
                        <td scope="col">' . formatDate($an['Date']) . ' <i class="far fa-eye text-primary font-weight-bold cns_profile_details_search" bl="' . $an['BL'] . '" cns="' . $an['ConsignmentID'] . '" containerNo="' . $an['ContainerNo'] . '"  data-toggle="modal" data-target="#ConsDetailsModal" style="padding-left:15px;"></i>  <i style="padding-left:15px;" class="fa fa-edit text-warning edit_pending_cons" data-toggle="modal" data-target="#editConsModals" mbl="' . $an['BL'] . '" containerNo="' . $bn['ContainerNo'] . '"></i></td>
                   </tr>
                  </tbody>';
        }
    }

    echo '<tbody>';
}
    ?>

    <style>
        .cns_profile_details_search {
            cursor: pointer;
        }
    </style>

    <script>
        $('.cns_profile_details_search').click(function() {
            let cns = $.trim($(this).attr('cns'));
            let mbl = $.trim($(this).attr('bl'));
            let containerNo = $.trim($(this).attr('containerNo'));

            $.post('insert_recno_rpt.php', {
                ldt: cns,
                sid: mbl,
                cid: containerNo
            }, function(a) {
                $('#display_consignment_detail_profile_list').load('load_consignment_profile_details_1.php');
            });

        });
    </script>