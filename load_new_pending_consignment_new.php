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
                                WHERE STATUS <> 0 
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

        $a = mysqli_query($dbc, "SELECT * FROM container_main_view_1 WHERE Status <> 0 ORDER BY ETA_Days ASC");

        if (mysqli_num_rows($a) > 0) {
            while ($an = mysqli_fetch_assoc($a)) { ?>

                <div class="accordion-item border border-white accordion-<?= $an['BL'] ?>">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-bl-status bg-<?php getNotificationColor($an['ETA_Days']); ?> text-white" type="button" data-bs-toggle="collapse" bl="<?= $an['BL']; ?>" eta="<?= $an['ETA_Days'] ?>" data-bs-target="#<?= $an['BL']; ?>" aria-expanded="true" aria-controls="<?= $an['BL']; ?>">
                            <span><?= $an['BL']; ?></span>
                            <span class="badge badge-<?php getNotificationColor($an['ETA_Days']); ?> m-1 p-1 border border-white"><?= $an['ConsigneeName']; ?></span>
                            <span class="badge badge-<?php getNotificationColor($an['ETA_Days']); ?> m-2 p-1 border border-white">ETA : <?= formatDate($an['ETA']); ?> [<?= $an['ETA_Days']; ?> days]</span>
                            <span class="badge bg-success-subtle text-secondary m-1 p-1"><?= $an['OfficerAssignedName']; ?></span>

                            <!-- Fetch all disbursement payments -->
                            <?php
                            //include("_template/components/pending_consignment_notification/disbursement_paid_account_pending.view.php");
                            ?>
                            <div id="<?= $an['BL'];  ?>" class="notification-div" style="border: 0px solid yellow; display:inline-block">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                        </button>
                    </h2>
                    <div id="<?= $an['BL']; ?>" class="accordion-collapse collapse" data-bs-parent="#activeDisbursement">
                        <div class="accordion-body" id="accordion-body-<?= $an['BL'] ?>">
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
        let eta = $.trim($(this).attr('eta'));

        $.post('load_consignment_payment_details.view.php', {
            id,
            eta
        }, function(result) {
            $(`#accordion-body-${id}`).html(result);
        });
    });
</script>