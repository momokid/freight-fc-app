<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');


$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

//require("_template/components/pending_consignment_notification/disbursement_paid_account_pending.view.php");  

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else { ?>

    <div class="accordion accordion-flush" id="activeDisbursement">

        <?php
        $b = mysqli_query($dbc, "SELECT 
                                CASE WHEN ETA_Days < 0 THEN 'OVERDUE' 
                                WHEN ETA_Days = 0 THEN 'ARRIVED' 
                                WHEN ETA_Days > 0 THEN 'PENDING' 
                                END AS ETA_Group, COUNT(*) AS Count 
                                FROM container_main_view_1 
                                WHERE STATUS = 1 
                                GROUP BY ETA_Group");
        ?>

        <div>
            <?php while ($bn = mysqli_fetch_assoc($b)) { ?>
                <span class="badge badge-<?php setStatusColor($bn['ETA_Group']); ?> m-1 p-2 border border-white"><?= $bn['ETA_Group'] ?>: <span class="badge text-bg-secondary"> <?= $bn['Count'] ?> </span></span>
            <?php } ?>
            <!-- <span class="badge badge-success m-1 p-2 border border-white">ARRIVED: <span class="badge text-bg-secondary"> <?= $bn['ARRIVED'] ?> </span></span>
            <span class="badge badge-danger m-1 p-2 border border-white">OVERDUE: <span class="badge text-bg-secondary"> <?= $bn['OVERDUE'] ?> </span></span> -->

        </div>

        <?php

        $a = mysqli_query($dbc, "SELECT DISTINCT BL, ConsigneeName, OfficerAssignedName, ETA_Days, ETA FROM container_main_view_1 WHERE Status = 1 ORDER BY ETA_Days ASC");

        if (mysqli_num_rows($a) > 0) {
            while ($an = mysqli_fetch_assoc($a)) { ?>

                <div class="accordion-item border border-white accordion-<?= $an['BL']."".$an['ContainerNo'] ?>">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-bl-status text-white" style="background-color:<?php getConsignmentStatusColor($an['BL'], $an['ContainerNo'], $an['ETA_Days']); ?>" type="button" data-bs-toggle="collapse" bl="<?= $an['BL']; ?>" containerNo="<?= $an['ContainerNo']; ?>" eta="<?= $an['ETA_Days'] ?>" data-bs-target="#<?= $an['BL'] . "" . $an['ContainerNo']; ?>" aria-expanded="true" aria-controls="<?= $an['BL'] . "" . $an['ContainerNo']; ?>">
                            <span><?= $an['BL']; ?> </span>
                            <span class="badge m-1 p-1 border border-white d-inline-block text-truncate" style="max-width:150px;" title="<?= $an['ConsigneeName']; ?>"><?= $an['ConsigneeName']; ?></span>
                            <span class="badge m-2 p-1 border border-white" style="background-color:<?php getNotificationColor($an['ETA_Days']) ?>; ">ETA : <?= formatDate($an['ETA']); ?> [<?= $an['ETA_Days']; ?> day<?=  checkForSPlural($an['ETA_Days']); ?>]</span>
                            <span class="badge bg-success-subtle text-secondary m-1 p-1 d-inline-block text-truncate" style="max-width:100px;" title="<?= $an['OfficerAssignedName']; ?>"><?= $an['OfficerAssignedName']; ?></span>

                            <!-- Fetch all disbursement payments -->
                            <?php
                            //include("_template/components/pending_consignment_notification/disbursement_paid_account_pending.view.php");
                            ?>
                            <div id="<?= $an['BL'] . "" . $an['ContainerNo']; ?>" class="notification-divss" style="border: 0px solid yellow; display:inline-block">
                                <div class="spinner-borders text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                        </button>
                    </h2>
                    <div id="<?= $an['BL'] . "" . $an['ContainerNo']; ?>" class="accordion-collapse collapse" data-bs-parent="#activeDisbursement">
                        <div class="accordion-body" id="accordion-body-<?= $an['BL'] . "" . $an['ContainerNo'] ?>">
                            Loading...
                            <div class="spinner-grow" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                </div>

            <?php } ?>
    </div>

<?php   }
    }
?>


<script>
    // $('.disbursementAccountPaidNotification').html("herrrrrr");
    $('.accordion-button-bl-status').click(function() {
        let id = $.trim($(this).attr('bl'));
        let containerNo = $.trim($(this).attr('containerNo'));
        let eta = $.trim($(this).attr('eta'));

        $.post('load_consignment_payment_details.view.php', {
            id,
            eta,
            containerNo
        }, function(result) {
            $(`#accordion-body-${id}${containerNo}`).html(result);
        });
    });
</script>