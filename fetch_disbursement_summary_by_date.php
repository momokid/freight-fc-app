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
                <th scope="col">DATE</th>
                <th scope="col">CONTAINER #</th>
                <th scope="col">NO. OF BL</th>
                <th scope="col">TOTAL REVENUE</th>
                <th scope="col">TOTAL EXPENDITURE</th>
                <th scope="col">SUB NET</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_distinct_hbl WHERE (Date BETWEEN '$fdt' AND '$ldt') AND Status=0");
            if (mysqli_num_rows($a) > 0) {

                $b = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_distinct_hbl_0 WHERE (Date BETWEEN '$fdt' AND '$ldt') AND Status=0 ORDER BY Time ASC");
                while ($an = mysqli_fetch_assoc($b)) {
                    $subNetIncome = $an['TotalCashReceipt'] - $an['TExpenditure'];
            ?>

                    <tr data-toggle="modal" id="<?= $an['ContainerNo'] ?>" data-target="#viewDisbursementDetails" class="trProcessedDisbursement">
                        <td scope="col"><?= strftime("%B %d, %Y", strtotime($an['Date'])) ?></td>
                        <td scope="col"><?= $an['ContainerNo'] ?></td>
                        <td scope="col"><?= $an['BL_COUNT'] ?></td>
                        <td scope="col"><?= number_format($an['TotalCashReceipt'], 2, '.', ',') ?></td>
                        <td scope="col"><?= number_format($an['TExpenditure'], 2, '.', ',') ?></td>
                        <td scope="col" class="<?= $subNetIncome < 0 ? 'text-danger' : 'text-primary'; ?>"><?= number_format(($subNetIncome), 2, '.', ',') ?></td>
                        <td scope="col"><?= $an['Type'] ?></td>
                    </tr>
                <?php }

                $c = mysqli_query($dbc, "SELECT ROUND(SUM(TExpenditure),2) AS TotalExpenditure, ROUND(SUM(TotalCashReceipt),2) as TotalRevenue, Status FROM disbursement_analysis_distinct_hbl_0 WHERE (Date BETWEEN '$fdt' AND '$ldt') AND Status=0 GROUP BY Status");
                while ($cn = mysqli_fetch_assoc($c)) {
                    $TotalNetIncome = $cn['TotalRevenue'] - $cn['TotalExpenditure'];
                ?>

                    <tr>
                        <td scope='col' colspan="3"></td>
                        <td scope='col' class="text-primary font-weight-bold"><?= number_format($cn['TotalRevenue'], 2, '.', ','); ?></td>
                        <td scope='col' class="text-danger font-weight-bold"><?= number_format($cn['TotalExpenditure'], 2, '.', ','); ?></td>
                        <td scope="col" colspan="2" class="font-weight-bold <?= $TotalNetIncome < 0 ? 'text-danger' : 'text-primary'; ?>"><?= number_format(($TotalNetIncome), 2, '.', ',') ?></td>
                    </tr>
                <?php  }
            } else { ?>

                <tr>
                    <td scope='col'>Disbursement Not Found Between <?= $fdt ?> And <?= $ldt ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
<?php }

?>

<style>
    .thead-lig {
        background: green;
        color: white;
    }

    .trProcessedDisbursement:hover {
        background: #bbb;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    //$('#DisbursementProcessView').DataTable();

    $('.trProcessedDisbursement').click(function() {
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