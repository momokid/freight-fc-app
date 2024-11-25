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
        <?php
        $gateOutDate = '';

        $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_1 WHERE Status = 2 OR Status=0");

        if (mysqli_num_rows($a) > 0) {
            $b = mysqli_query($dbc, "SELECT DISTINCT BL, ConsigneeName,OfficerName FROM disbursement_analysis_unauth_2 WHERE Status = 2 ORDER BY Date ASC");
            while ($bn = mysqli_fetch_assoc($b)) { ?>
                <div class="card text-bg-info mb-3 tbody-panel-<?= $bn['BL']?>" style="max-width: 50vw;">
                    <div class="card-header text-bg-info">
                        <span class="fw-bold"><?= $bn['ConsigneeName'] ?> </span>
                        <span>#<?= $bn['BL'] ?> </span>
                        <span class="badge rounded-pill text-bg-dark p-1">by: <?= $bn['OfficerName'] ?></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">DISBURSEMENT DETAILS</h5>
                        <table class="table table-striped table-hover table-bordered table-info">
                            <thead class="text-center table-dark">
                                <tr>
                                    <th scope="col">ITEM</th>
                                    <th scope="col">AMOUNT PAID</th>
                                    <th scope="col">T. DATE</th>
                                    <th scope="col">RECEIPT #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_2 WHERE BL = '$bn[BL]' ORDER BY Status ASC");
                                while ($cn = mysqli_fetch_assoc($c)) {
                                    $gateOutDate = $cn['GateOutDate']
                                ?>

                                    <tr>
                                        <td><?= $cn['AccountName'] ?></td>
                                        <td><?= formatNumber($cn['Expenditure']) ?></td>
                                        <td><?= formatDate($cn['Date']) ?></td>
                                        <td><?= $cn['ReceiptNo'] ?> <i class="fas fa-check"></i></td>
                                    </tr>
                                <?php  }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-bg-info">
                        Gated Out: <span class="fw-bold"><?= $gateOutDate != null ? formatDate($gateOutDate) : "PENDING"; ?></span>
                    </div>
                    <button type="button" class="btn btn-primary mb-2 btn-approve-disbursement" data-bl="<?= $bn['BL'] ?>">Approve</button>
                    <button type="button" class="btn btn-danger btn-reject-disbursement" data-bl="<?= $bn['BL'] ?>" data-bl="<?= $cn['BL'] ?>">Reject</button>

                </div>
            <?php }
        } else { ?>
            <div>No disbursement pending</div>
        <?php }
        ?>
    </div>
<?php }
?>

<style>
    .fa-btn {
        cursor: pointer;
    }
</style>

<script>
    //Autdorize disrbursement analysis
    $('.btn-approve-disbursement').click(function() {
        let bl = $.trim($(this).attr('data-bl'))

        $(".progress-loader").remove();
        $("body").append(
            '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        let ansa = confirm("Approved disbursement?");

        if (ansa) {
            $.post('disbursement_analysis_approved.php', {
                bl,
            
            }, function(data) {
                let result = JSON.parse(data);

                alert(result.msg)
                $(`.tbody-panel-${bl}`).fadeOut();
                $("#display_disbursement_analysis").load("load_disbursement_analysis_approval_new.php");
                $(".progress-loader").remove();
            });
        }

    });


    $('.btn-reject-disbursement').click(function() {
        let bl = $.trim($(this).attr('data-id'))
        let userName = $.trim($(this).attr('data-user'))

        $(".progress-loader").remove();
        $("body").append(
            '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        // alert(`${userName} ${receiptNo}`);
        let ansa = confirm("Reject disbursement?");

        if (ansa) {
            $.post('disbursement_analysis_reject.php', {
                bl,
                userName,
                containerNo
            }, function(data) {
                let result = JSON.parse(data);

                if (result.status_code == 200) {
                    $(`.tbody-panel-${containerNo}`).fadeOut();
                    $(".progress-loader").remove();
                } else {
                    alert(result.msg)
                    $(".progress-loader").remove();
                }




            });
        }
    })
</script>