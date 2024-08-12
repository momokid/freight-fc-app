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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class='thead-dark'>
                <th colspan="4">CONTAINER DETAILS</th>
            </thead>



            <?php
            $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_1 WHERE Status='2'");

            if (mysqli_num_rows($a) > 0) {
                $b = mysqli_query($dbc, "SELECT DISTINCT ConsigneeName, ContainerNo, BL, ETA, ETA_Days, OfficerAssignedName, Date, ReceiptNo, TotalCashReceipt, Username FROM disbursement_analysis_unauth_1 WHERE Status='2' ORDER BY Date ASC");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <tbody class="tbody-panel-<?= $bn['ReceiptNo']?>">
                        <tr class='table-warning'>
                            <td colspan='2' class="font-weight-bold text-dark">CONTAINER# / BL# : <?= $bn["BL"] . ' / ' . $bn['ContainerNo']; ?></td>
                            <td colspan='2' class="font-weight-bold text-dark"> TRANS. DATE / ASSIGNED OFFICER : <?= formatDate($bn['Date']) ?> / <?= $bn['OfficerAssignedName'] ?></td>
                        </tr>

                        <tr class=''>
                            <td colspan="2" class="font-weight-bold text-dark">TOTAL CASH REVENUE: <span class="text-primary"> <?= formatToCurrency($bn["TotalCashReceipt"]); ?> </span></td>
                            <td colspan="2" class="font-weight-bold">CONSIGNEE: <?= $bn["ConsigneeName"]; ?></td>
                        </tr>

                        <tr class=''>
                            <td colspan="1" class="font-weight-bold text-<?= getNotificationColor($bn['ETA_Days'])  ?>">ETA : <?= formatDate($bn["ETA"]); ?> : [<?= ($bn["ETA_Days"]); ?> Days]</td>
                            <td colspan="3" class="font-weight-bold"></td>
                        </tr>

                        <?php
                        $c = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_1 WHERE Status='2' AND BL='$bn[BL]' AND ContainerNo='$bn[ContainerNo]'");
                        while ($cn = mysqli_fetch_assoc($c)) { ?>
                            <tr class=''>
                                <td class=""></td>
                                <td class=""> <?= $cn["AccountName"] ?></td>
                                <td class=""><?= formatToCurrency($cn['Expenditure']) ?></td>
                                <td class=""></td>
                            </tr>
                        <?php    }
                        ?>

                        <?php
                        $d = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS TotalExpenditure, TotalCashReceipt FROM disbursement_analysis_unauth_1 WHERE Status='2' AND BL='$bn[BL]' AND ContainerNo='$bn[ContainerNo]' Group By BL, ContainerNo");
                        while ($dn = mysqli_fetch_assoc($d)) { ?>
                            <tr class=''>
                                <td class=""></td>
                                <td class="font-weight-bold">TOTAL EXPENDITURE</td>
                                <td class="text-danger font-weight-bold"><?= formatToCurrency($dn['TotalExpenditure']) ?></td>
                                <td class=""></td>
                            </tr>

                            <?php $pnl = $dn['TotalCashReceipt'] - $dn['TotalExpenditure']; ?>
                            <tr>
                                <td></td>
                                <td class="border border-dark border-right-0 font-weight-bold">PROFIT/LOSS (#<?= $bn["ContainerNo"] ?>)</td>
                                <td class="border border-dark border-left-0 <?= $pnl > 0 ? "text-success" : "text-danger" ?>"> <span class="font-weight-bold"><?= formatToCurrency($pnl); ?></span></td>
                                <td><button class="btn btn-success fa-btn btn-approve-disbursement" id="<?= $bn['ReceiptNo'] ?>" title="Approve Disbursement Analysis">APPROVE</button> <button class="btn btn-secondary btn-reject-disbursement" id="<?= $bn['ReceiptNo'] ?>" user="<?= $bn['Username'] ?>" title="Reject Disbursement Analysis">DECLINE</button></td>
                            </tr>
                        <?php  }
                        ?>
                        <tr>
                            <td colspan="4">.</td>
                        </tr>
                    </tbody>
                <?php }
            } else { ?>
                <tbody class=" border border-danger">
                    <tr class='table-dark'>
                        <td colspan='5' class="font-weight-bold text-dark p-2">No disbursement pending</td>
                    </tr>
                </tbody>
            <?php }
            ?>


        </table>
    <?php }
    ?>

    <style>
        .fa-btn {
            cursor: pointer;
        }
    </style>

    <script>
        //Authorize disrbursement analysis
        $('.btn-approve-disbursement').click(function() {
            let receiptNo = $.trim($(this).attr('id'))

            $(".progress-loader").remove();
            $("#disbursementAnalysisModalContent").append(
                '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
            );

            let ansa = confirm("Approved disbursement?");

            if (ansa) {
                $.post('disbursement_analysis_approved.php', {
                    receiptNo
                }, function(data) {
                    let result = JSON.parse(data);

                    alert(result.msg)
                    $(`.tbody-panel-${receiptNo}`).fadeOut();
                    $("#display_disbursement_analysis_panel").load("load_disbursement_analysis_approval_new.php");
                    $(".progress-loader").remove();
                });
            }

        });


        $('.btn-reject-disbursement').click(function() {
            let receiptNo = $.trim($(this).attr('id'))
            let userName = $.trim($(this).attr('user'))

            $(".progress-loader").remove();
            $("#disbursementAnalysisModalContent").append(
                '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
            );
            // alert(`${userName} ${receiptNo}`);
            let ansa = confirm("Reject disbursement?");

            if (ansa) {
                $.post('disbursement_analysis_reject.php', {
                    receiptNo,
                    userName
                }, function(data) {
                    let result = JSON.parse(data);

                    alert(result.msg)
                    $(`.tbody-panel-${receiptNo}`).fadeOut();
                    $("#display_disbursement_analysis_panel").load("load_disbursement_analysis_approval_new.php");

                    $(".progress-loader").remove();
                });
            }
        })
    </script>