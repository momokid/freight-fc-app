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

    <div class="table-responsive">
        <?php

        $a = mysqli_query($dbc, "SELECT * FROM container_gate_out_view WHERE Status = 3");

        if (mysqli_num_rows($a) > 0) { ?>
            <table class="table table-stripe table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>BL#</th>
                        <th>CONTAINER#</th>
                        <th>DEMURRAGE</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr title="Gate-Out on: <?= formatDate($an['GateOutDate']) ?>">
                            <td><?= $an['BL'] ?></td>
                            <td><?= $an['ContainerNo'] ?></td>
                            <td><?= $an['Demurrage'] ?> day<?= checkForSPlural($an['Demurrage']) ?>
                                <?= getGateOutExpense($an['BL'], $an['ContainerNo']) === 1 ? '<i class="fas fa-check text-warning gate-out-confirm" id="' . $an['BL'] . '" containerNo="' . $an['ContainerNo'] . '" style="cursor: pointer;" title="Confirm container return"></i> <span class="spinner-grow spinner-grow-sm visually-hidden" aria-hidden="true"></span>' : "" ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>


            </table>
    </div>
<?php } else {
        }
    }

?>




<script>
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

    $('.gate-out-confirm').click(function() {
        let bl = $.trim($(this).attr('id'));
        let containerNo = $.trim($(this).attr('containerNo'));

        let q = confirm('Confirm container return?')

        if (q) {
            $.ajax({
                url: 'update_gate_out_return_approval.php', // 
                data:{bl, containerNo},
                type: 'POST',
                success: function(response) {
                    let data =JSON.parse(response);

                    alert(data.msg);
                    // $('#data-section').html(data);
                },
                error: function(error) {
                    // Handle errors here
                    console.error("Error: "+ error);
                }
            });
        } else {
            return false;
        }

    });
</script>