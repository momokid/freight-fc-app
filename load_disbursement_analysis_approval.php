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
} else {

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_3 WHERE Status='2'");

    if (mysqli_num_rows($a) > 0) {

        echo "
            <table class='table'>
                <thead class='thead-dark'>
                    <th>CONTAINER DETAILS</th>
                    <th></th>
                    <th></th>
                    <th>ACTION</th>
                </thead>        
        ";
        $b = mysqli_query($dbc, "SELECT DISTINCT ContainerNo, Type,Date FROM disbursement_analysis_unauth_3 WHERE Status='2' ORDER BY Date ASC");
        while ($bn = mysqli_fetch_assoc($b)) { ?>
            <!-- Display Container No -->
            <!-- <tr>
                    <td>CONTAINER DETAILS</td>
                </tr> -->
            <tr class='table-dark'>
                <td colspan='2' class="font-weight-bold text-dark"> <?= $bn["ContainerNo"] . ' ~ ' . $bn['Type']; ?></td>
                <td colspan='2' class="font-weight-bold text-dark">  DATE OF TRANSACTION: <?= formatDate($bn['Date'])?></td>
            </tr>

            <!-- Display Total Cash Receipt -->
            <?php
            $c = mysqli_query($dbc, "SELECT DISTINCT TotalCashReceipt FROM disbursement_analysis_unauth_3 WHERE Status='2' AND ContainerNo='$bn[ContainerNo]'");
            while ($cn = mysqli_fetch_assoc($c)) { ?>
                <tr>
                    <td>TOTAL CASH RECEIVED:</td>
                    <td colspan="2" class="text-primary font-weight-bold"><?= formatToCurrency($cn['TotalCashReceipt']); ?></td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
                $d = mysqli_query($dbc, "SELECT DISTINCT ConsigneeID, ConsigneeName,HBL, Description FROM disbursement_analysis_unauth_3 WHERE Status='2' AND ContainerNo='$bn[ContainerNo]'");
                while ($dn = mysqli_fetch_assoc($d)) { ?>
                    <tr>
                        <td></td>
                        <td colspan="3" class="text-align-center font-weight-bold"><?= $dn['ConsigneeName'] . ' --- ' . $dn['HBL'] . ' --- <span class="text-info">' . $dn['Description'] . ' </span>' ?></td>
                    </tr>

                    <?php
                    $e = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_unauth_3 WHERE Status='2' AND ContainerNo='$bn[ContainerNo]' AND HBL='$dn[HBL]' AND ConsigneeID='$dn[ConsigneeID]'");
                    while ($en = mysqli_fetch_assoc($e)) { ?>
                        <tr>
                            <td></td>
                            <td>*<?= $en['AccountName'] ?></td>
                            <td> <?= formatToCurrency($en['Expenditure']); ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>

                    <?php
                    $f = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS TExpenditure  FROM disbursement_analysis_unauth_3 WHERE Status='2' AND ContainerNo='$bn[ContainerNo]' AND HBL='$dn[HBL]' AND ConsigneeID='$dn[ConsigneeID]'");
                    while ($fn = mysqli_fetch_assoc($f)) { ?>
                        <tr>
                            <td></td>
                            <td class="border border-dark border-right-0">Sub-Total</td>
                            <td class="border border-dark border-left-0"> <span class="font-weight-bold"><?= formatToCurrency($fn['TExpenditure']); ?></span></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td>.</td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>

            <?php } ?>

            <?php
            $g = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS GTExpenditure, TotalCashReceipt FROM disbursement_analysis_unauth_3 WHERE Status='2' AND ContainerNo='$bn[ContainerNo]'");
            while ($gn = mysqli_fetch_assoc($g)) { ?>
                <tr>
                    <td></td>
                    <td class="border border-dark border-right-0">TOTAL EXPENDITURE</td>
                    <td class="border border-dark border-left-0"> <span class="font-weight-bold"><?= formatToCurrency($gn['GTExpenditure']); ?></span></td>
                    <td></td>
                </tr>
                <?php $pnl = $gn['TotalCashReceipt']-$gn['GTExpenditure']; ?>
                <tr>
                    <td></td>
                    <td class="border border-dark border-right-0">PROFIT/LOSS (#<?=$bn["ContainerNo"] ?>)</td>
                    <td class="border border-dark border-left-0 <?= $pnl > 0 ? "text-success" : "text-danger" ?>"> <span class="font-weight-bold"><?= formatToCurrency($pnl); ?></span></td>
                    <td><i class="fas fa-check-square fa-lg bg-transparent text-success fa-btn" title="Approve Disbursement Analysis"></i> <i class="fas fa-grip-lines-vertical fa-lg"></i> <i class="fas fa-window-close fa-lg bg-transparent text-warning fa-btn"  title="Reject Disbursement Analysis"></i></td>
                </tr>

                <tr>
                        <td></td>
                        <td>.</td>
                        <td></td>
                        <td></td>
                    </tr>
        <?php }
        } ?>


        </table>

<?php  }
}

?>
<style>
    .fa-btn{
        cursor: pointer;
    }
</style>