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
}

$date = mysqli_query($dbc, "SELECT * FROM rpt_multi_values WHERE Username='$Uname'");
if (mysqli_num_rows($date) == 0) {
    die('Error Fetching Data');
} else {
    $dt = mysqli_fetch_assoc($date);

    $containerNo = $dt['SubjectID'];
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
           CONTAINER DISBURSEMENT DETAILS REPORT:<?= $containerNo ?>
        </title>

        <?php include('script.php'); ?>
    </head>

    <body>

        <?php



        $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_view WHERE ContainerNo='$containerNo'");

        if (mysqli_num_rows($a) > 0) { ?>


            <table class='table'>
                <thead class='thead-dark'>
                    <th>CONTAINER DISBURSEMENT DETAILS</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>

                <?php
                $b = mysqli_query($dbc, "SELECT DISTINCT ContainerNo, Type,Date,ReceiptNo,Username FROM disbursement_analysis_view_1 WHERE ContainerNo='$containerNo'");
                while ($bn = mysqli_fetch_assoc($b)) { ?>
                    <!-- Display Container No -->

                    <tr class='table-dark'>
                        <td colspan='2' class="font-weight-bold text-dark"> <?= $bn["ContainerNo"] . ' ~ ' . $bn['Type']; ?></td>
                        <td colspan='2' class="font-weight-bold text-dark"> DATE OF TRANSACTION: <?= formatDate($bn['Date']) ?></td>
                    </tr>

                    <!-- Display Total Cash Receipt -->
                    <?php
                    $c = mysqli_query($dbc, "SELECT DISTINCT TotalCashReceipt FROM  disbursement_analysis_view_1 WHERE ContainerNo='$containerNo'");
                    while ($cn = mysqli_fetch_assoc($c)) { ?>
                        <tr>
                            <td>TOTAL CASH REVENUE:</td>
                            <td colspan="2" class="text-primary font-weight-bold"><?= formatToCurrency($cn['TotalCashReceipt']); ?></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <?php
                        $d = mysqli_query($dbc, "SELECT DISTINCT ConsigneeID, ConsigneeName,HBL, Description FROM disbursement_analysis_view_1 WHERE ContainerNo='$containerNo'");
                        while ($dn = mysqli_fetch_assoc($d)) { ?>
                            <tr>
                                <td></td>
                                <td colspan="3" class="text-align-center font-weight-bold"><?= $dn['ConsigneeName'] . ' --- ' . $dn['HBL'] . ' --- <span class="text-info">' . $dn['Description'] . ' </span>' ?></td>
                            </tr>

                            <?php
                            $e = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_view_2 WHERE ContainerNo='$containerNo' AND HBL='$dn[HBL]' AND ConsigneeID='$dn[ConsigneeID]'");
                            while ($en = mysqli_fetch_assoc($e)) { ?>
                                <tr>
                                    <td></td>
                                    <td>*<?= $en['AccountName'] ?></td>
                                    <td> <?= formatToCurrency($en['Expenditure']); ?></td>
                                    <td></td>
                                </tr>
                            <?php } ?>

                            <?php
                            $f = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS TExpenditure  FROM disbursement_analysis_view_2 WHERE ContainerNo='$containerNo'  AND HBL='$dn[HBL]' AND ConsigneeID='$dn[ConsigneeID]'");
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
                                <td class="text-white">.</td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php } ?>

                    <?php } ?>

                    <?php
                    $g = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS GTExpenditure, TotalCashReceipt FROM disbursement_analysis_view_2 WHERE ContainerNo='$containerNo'");
                    while ($gn = mysqli_fetch_assoc($g)) { ?>
                        <tr>
                            <td></td>
                            <td class="border border-dark border-right-0">TOTAL EXPENDITURE</td>
                            <td class="border border-dark border-left-0"> <span class="font-weight-bold"><?= formatToCurrency($gn['GTExpenditure']); ?></span></td>
                            <td></td>
                        </tr>
                        <?php $pnl = $gn['TotalCashReceipt'] - $gn['GTExpenditure']; ?>
                        <tr>
                            <td></td>
                            <td class="border border-dark border-right-0">PROFIT/LOSS (#<?= $bn["ContainerNo"] ?>)</td>
                            <td class="border border-dark border-left-0 <?= $pnl > 0 ? "text-success" : "text-danger" ?>"> <span class="font-weight-bold"><?= formatToCurrency($pnl); ?></span></td>
                            <td><i class="fas fa-print fa-lg bg-transparent cursor-pointer no-print" onClick="window.print()" title="Print this document"></i></td>
                        </tr>

                    <?php } ?>
                <?php } ?>


            </table>

    <?php  } else {
            die("Container# {$contaierNo} details not found.");
        }
    }


    ?>

    </body>
    </html>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>