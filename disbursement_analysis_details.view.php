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
    $bl = $dt['Sub_ClassID'];

    $netExp = 0;
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            Consignment Expense Summary Report:<?= $containerNo ?>
        </title>

        <?php include('script.php'); ?>
    </head>

    <body>
        <div class="d-flex flex-column justify-content-evenly align-items-center mt-3 mb-3">


            <!-- Details -->
            <?= reportCompanyHeading($BranchID) ?>

            <!-- Report title -->
            <div class="d-flex flex-column align-items-center">
                <span class="fw-semibold">Consignment Expense Summary Report - <?= $bl ?> #<?= $containerNo ?></span>
            </div>

        </div>

        <?php

        $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_view WHERE ContainerNo='$containerNo' AND BL='$bl' ORDER BY Date Asc");

        if (mysqli_num_rows($a) > 0) { ?>

            <div class="table-responsive px-2" style="width: 100vw;">
                <table class='table table-bordered'>
                    <thead class='thead-dark'>
                        <th>DATE</th>
                        <th>ACCOUNT NAME</th>
                        <th>AMOUNT</th>
                        <th>EXPENDITURE TYPE</th>
                        <th>RECEIPT #</th>

                    </thead>

                    <?php
                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td><?= formatDate($an['Date']) ?></td>
                            <td><?= $an['AccountName'] ?></td>
                            <td><?= formatToCurrency($an['Expenditure']) ?></td>
                            <td><?= $an['Stamp'] ?></td>
                            <td><?= $an['ReceiptNo'] ?></td>

                        </tr>
                    <?php  }

                    $b = mysqli_query($dbc, "SELECT ROUND(SUM(Expenditure),2) AS TExp, Stamp FROM disbursement_analysis_view WHERE ContainerNo='$containerNo' AND BL='$bl' GROUP BY Stamp"); ?>

                    <tr>
                        <td colspan="5" class="text-white">.</td>
                    </tr>

                    <?php while ($bn = mysqli_fetch_assoc($b)) { 
                    $netExp += $bn['TExp'];    
                    ?>
                        <tr>
                            <td>TOTAL <?= $bn['Stamp'] ?></td>
                            <td colspan="4"><?= formatToCurrency($bn['TExp']) ?></td>
                        </tr>
                    <?php  } ?>

                    <tr class="font-weight-bold">
                        <td>NET EXPENDITURE</td>
                        <td class="text-danger" colspan="4"><?= formatToCurrency($netExp) ?></td>
                    </tr>
                </table>
            </div>
            <div class="px-2">
                <i class="fas fa-print fa-lg bg-transparent cursor-pointer no-print" onClick="window.print()" title="Print this document"></i>
            </div>
            <!-- <td><i class="fas fa-print fa-lg bg-transparent cursor-pointer no-print" onClick="window.print()" title="Print this document"></i></td> -->
    </body>

    </html>
<?php  }
    }


?>



<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>