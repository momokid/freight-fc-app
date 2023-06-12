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
    <title>FINANCIAL STATEMENT</title>
    <?php
    include 'script.php';
    ?>
</head>

<body style="border: 0px solid green;">
    <?php $d = mysqli_query($dbc, "select * from pnl_transaction_general where AccountID='$an[Value1]' and (Date BETWEEN '$an[FDate]' and '$an[LDate]')");
    $dn = mysqli_fetch_assoc($d);

    ?>
    <table class="" style="width:1000px;border: 0px solid red;margin-top: 5px;color:black;margin-left: 10px;">
        <thead>
            <tr style="font-weight:bold;" width="140">
                <td style="text-align: center;">
                    <div><img src="img/logo1.png" height="100rem" /></div>
                </td>
                <td colspan="3" scope="col" style="text-align: center;">
                    <div style="font-size: 15px;text-transform: uppercase;"><?php echo $bn['InstName']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Address']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Email']  ?></div>
                    <div style="font-size: 15px;"><?php echo $bn['Location']  ?></div>
                </td>
                <td width="300;">
                    <div style="margin-top:-2rem;padding:0.5rem;float:right;background:orangered;color:white;">
                        <span style="font-size: 15px;">FINANCIAL STATEMENT</span><br>
                        <span style="font-size: 15px;">BRANCH: <?php echo $dn['AccountName']; ?></span><br>
                        <span style="font-size: 15px;">STATEMENT AS @: <?php echo strftime("$dtf", strtotime($an['LDate'])); ?></span>
                    </div>
                </td>
            </tr>
        </thead>
        <?php
        $c = mysqli_query($dbc, "select * from financial_statement_view_1 where RptUser='$Uname'");

        if (mysqli_num_rows($c) == 0) {
            die('<table class="tbl-error" style="margin-top: 50px;
            font-weight: bold;
            font-size: 24px;"><tr><td>Report details not found</td></tr></table>');
        }

        ?>
        <tbody>
            <tr class="tbl-head-border">
                <td colspan="5">
                    <div style="border:1px solid black;margin:20px 0px;"></div>
                </td>
            </tr>
            <tr class="tbl-data no-border">
                <td colspan="4" class="no-border"></td>
                <td colspan="1" class="no-border">GHC</td>
            </tr>
            <?php
            $b = mysqli_query($dbc, "select distinct CategoryID,CategoryName from financial_statement_view_1 where RptUser='$Uname'");
            while ($bn = mysqli_fetch_assoc($b)) { ?>
                <tr class="tbl-data-header">
                    <td colspan="5" class="bg-black"><?php echo $bn['CategoryName'] ?></td>
                </tr>
                <?php
                $c = mysqli_query($dbc, "select distinct SubCategoryID,SubCategoryName from financial_statement_view_1 where CategoryID='$bn[CategoryID]' and RptUser='$Uname'");
                while ($cn = mysqli_fetch_assoc($c)) { ?>
                    <tr class="tbl-data tbl-final">
                        <td colspan="1"><?php echo $cn['SubCategoryName'] ?></td>
                        <td colspan="3" class="no-border"></td>
                    </tr>
                    <?php
                    $d = mysqli_query($dbc, "select * from financial_statement_view_1 where CategoryID='$bn[CategoryID]' and SubCategoryID='$cn[SubCategoryID]' and RptUser='$Uname' order by AccountName");
                    while ($dn = mysqli_fetch_assoc($d)) { ?>
                        <tr class="tbl-data">
                            <td class="no-border"></td>
                            <td colspan="2"><?php echo $dn['AccountName'] ?></td>
                            <td colspan="2"><?php echo $dn['TBal'] ?></td>
                        </tr>
                    <?php }
                    $e = mysqli_query($dbc, "select round(sum(TBal),2) as CatBal from financial_statement_view_1 where SubCategoryID='$cn[SubCategoryID]' and RptUser='$Uname'");
                    while ($en = mysqli_fetch_assoc($e)) { ?>
                        <tr class="tbl-data tbl-final">
                            <td colspan="2" class="no-border"></td>
                            <td colspan="1">TOTAL <?php echo $cn['SubCategoryName'] ?></td>
                            <td colspan="2"><?php echo $en['CatBal'] ?></td>
                        </tr>
                    <?php };
                }
                $f = mysqli_query($dbc, "select round(sum(TBal),2) as TBal from financial_statement_view_1 where CategoryID='$bn[CategoryID]' and RptUser='$Uname'");
                while ($fn = mysqli_fetch_assoc($f)) { ?>
                    <tr class="tbl-data tbl-final">
                        <td colspan="2" class="no-border"></td>
                        <td class=" no-border"></td>
                        <td colspan="1" class="bg-black">TOTAL <?php echo $bn['CategoryName'] ?></td>
                        <td colspan="2" class="bg-black"><?php echo $fn['TBal'] ?></td>
                    </tr>
                    <tr>
                        <td class="no-border">.</td>
                    </tr>
                <?php }
            }

            $g = mysqli_query($dbc, "select round(sum(TBal),2) as TBal from financial_statement_view_1 where RptUser='$Uname'");
            while ($gn = mysqli_fetch_assoc($g)) { ?>
                <tr class="tbl-data tbl-final">
                    <td colspan="5">DIFFERENCE : <?php echo $gn['TBal'] ?></td>
                </tr>
            <?php }
            ?>

        </tbody>

    </table>
    <div style="height: 0px;" class="m-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.open('view_financial_statement_report.php')" value="PRINT VIEW">
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
    }

    .tbl-final td {
        font-weight: bold;
        border: 1px solid black;
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