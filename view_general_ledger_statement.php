<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values_0 where Username='$Uname'");
    $b = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");

    if (mysqli_num_rows($b) == 0) {
        die('Error detected: Report not genarated.');
    } else {
        $bn = mysqli_fetch_assoc($b);

        if (mysqli_num_rows($a) == 0) {
            die('Records not found');
        } elseif (mysqli_num_rows($a) <> 1) {
            die('Multiple records detected');
        } else {
            $an = mysqli_fetch_assoc($a);
        }
    }
}


?>

<!doctype html>

<html>

<head>
    <title>GENERAL LEDGER STATEMENT BY ACCOUNT</title>
    <?php
    include 'script.php';
    ?>
</head>

<body style="border: 0px solid green;">
    <?php $d = mysqli_query($dbc, "select * from gl_statement_sub_account where AccountID='$an[Value1]' and (Date BETWEEN '$an[FDate]' and '$an[LDate]')");
    $dn = mysqli_fetch_assoc($d);

    ?>
    <table class="" style="width:1000px;border: 0px solid red;margin-top: 5px;color:black;margin-left: 10px;">
        <thead>
            <tr style="font-weight:bold;" width="140">
                <td style="text-align: center;">
                    <div><img src="img/logo1.png" height="100rem" /></div>
                </td>
                <td colspan="2" scope="col" style="text-align: center;">
                    <div style="font-size: 15px;text-transform: uppercase;"><?php echo $bn['InstName']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Address']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Email']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Location']  ?></div>
                </td>
                <td colspan="3" width="500;">
                    <div style="margin-top:0rem;padding:0.4rem;float:right;background:orangered;color:white;">
                        <span style="font-size: 14px;">GENERAL LEDGER STATEMENT BY ACCOUNT</span><br>
                        <span style="font-size: 14px;">ACCOUNT: <?php echo $dn['AccountName']; ?></span><br>
                        <span style="font-size: 14px;">DATE: <?php echo strftime("$dtf", strtotime($an['FDate'])); ?> <em>TO</em> <?php echo strftime("$dtf", strtotime($an['LDate'])); ?></span>
                    </div>
                </td>
            </tr>
        </thead>
        <?php
        $c = mysqli_query($dbc, "select * from gl_statement_sub_account where AccountID='$an[Value1]' and (Date BETWEEN '$an[FDate]' and '$an[LDate]') order by Date asc");

        if (mysqli_num_rows($c) == 0) {
            die('Transaction details not found');
        }
        ?>
        <tbody>
            <tr class="tbl-head-border">
                <td colspan="6">
                    <div style="border:1px solid black;margin:20px 0px;"></div>
                </td>
            </tr>
            <tr class="tbl-data-header">
                <td>DATE</td>
                <td width="120">RECEIPT NO.</td>
                <td width="800p">DESCRIPTION</td>
                <td width="140">CREDIT</td>
                <td width="150">DEBIT</td>
                <td width="150">BALANCE</td>
            </tr>
            <?php $s = mysqli_query($dbc, "select * from gl_statement_sub_account where AccountID='$an[Value1]' and Date <'$an[FDate]'");

            if (mysqli_num_rows($s) > 0) {
                $v = mysqli_query($dbc, "select round(sum(Cr),2) as TCr, round(sum(Dr),2) as TDr, round(sum(Cr)-sum(Dr),2) as BBF from gl_statement_sub_account where AccountID='$an[Value1]' and Date < '$an[FDate]'");
                $sn = mysqli_fetch_assoc($v);
                echo "
                <tr class='tbl-data'>
                    <td>" . strftime("$dtf", strtotime($an['FDate'])) . "</td>
                    <td>###</td>
                    <td>BALANCE B/F AS @ " . strftime("$dtf", strtotime($an['FDate'])) . "</td>
                    <td>" . number_format($sn['TCr'], 2, '.', ',') . "</td>
                    <td>" . number_format($sn['TDr'], 2, '.', ',') . "</td>
                    <td>" . number_format($sn['BBF'], 2, '.', ',') . "</td>
                </tr>";
            }
            $Bal = $sn['BBF'] ? $sn['BBF'] : 0;
            $BBF = $sn['BBF'] ? $sn['BBF'] : 0;
            ?>

            <?php while ($cn = mysqli_fetch_assoc($c)) {
                $Bal  = ($cn['Cr'] - $cn['Dr']) + $Bal;
            ?>

                <tr class="tbl-data">
                    <td><?php echo strftime("$dtf", strtotime($cn['Date'])); ?></td>
                    <td><?php echo $cn['ReceiptNo']; ?></td>
                    <td><?php echo $cn['Description']; ?></td>
                    <td><?php echo number_format($cn['Cr'], 2, '.', ','); ?></td>
                    <td><?php echo number_format($cn['Dr'], 2, '.', ','); ?></td>
                    <td><?php echo number_format($Bal, 2, '.', ','); ?></td>
                </tr>
            <?php } ?>

            <?php $e = mysqli_query($dbc, "select round(sum(Cr),2) as TCr, round(sum(Dr),2) as TDr, round(sum(Cr)-sum(Dr),2) as TBal from gl_statement_sub_account where AccountID='$an[Value1]' and (Date BETWEEN '$an[FDate]' and '$an[LDate]')");
            $f = mysqli_query($dbc, "select round(sum(Cr),2) as TCr, round(sum(Dr),2) as TDr, round(sum(Cr)-sum(Dr),2) as TBal from gl_statement_sub_account where AccountID='$an[Value1]'");
            $fn = mysqli_fetch_assoc($f);

            $en = mysqli_fetch_assoc($e); ?>
            <tr class="tbl-final">
                <td colspan="3">Balance BBF as @ <u><?php echo strftime("$dtf", strtotime($an['FDate'])) ?></u> : <?php echo number_format($BBF, 2, '.', ','); ?></td>
                <td><?php echo number_format($fn['TCr'], 2, '.', ','); ?></td>
                <td><?php echo number_format($fn['TDr'], 2, '.', ','); ?></td>
            </tr>
            <tr class="tbl-final">
                <td colspan="3">Total credit from <u><?php echo strftime("$dtf", strtotime($an['FDate'])) ?></u> to <u><?php echo strftime("$dtf", strtotime($an['LDate'])) ?></u> : <?php echo number_format($en['TCr'], 2, '.', ','); ?></td>
            </tr>
            <tr class="tbl-final">
                <td colspan="3">Total debit from <u><?php echo strftime("$dtf", strtotime($an['FDate'])) ?></u> to <u><?php echo strftime("$dtf", strtotime($an['LDate'])) ?></u>: <?php echo number_format($en['TDr'], 2, '.', ','); ?></td>
            </tr>
            <tr class="tbl-final">
                <td colspan="3">Account balance from <u><?php echo strftime("$dtf", strtotime($an['FDate'])) ?></u> to <u><?php echo strftime("$dtf", strtotime($an['LDate'])) ?></u>: <?php echo number_format($en['TBal'], 2, '.', ','); ?></td>
            </tr>

        </tbody>

    </table>
    <div style="height: 0px;" class="m-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="Donwload PDF">
    </div>
</body>

</html>
<style>
    th,
    tr,
    td {
        border: 0px solid black;
    }

    .tbl-data-header td {
        font-size: 14px;
        border: 1px solid black;
        padding: 2px;
        text-align: center;
        font-weight: bold;
        background: black;
        color: white;
    }

    .tbl-data td {
        text-align: left;
        border: 1px solid black;
        padding-left: 3px;
        text-transform: uppercase;
        text-align: center;
        font-size: 13px;
    }

    .tbl-final td {
        font-weight: bold;
        border: 1px solid black;
        font-size: 14px;
    }

    @media print {
        @page {
            size: landscape
        }
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>