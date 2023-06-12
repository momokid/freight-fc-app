<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');
?>



<?php
$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
//$e=  mysqli_real_escape_string($dbc,$_POST['e']);
//$TID=  mysqli_real_escape_string($dbc,$_POST['TID']);


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $result = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");
    $a =  mysqli_query($dbc, "SELECT * FROM rpt_multi_values where Username='$Uname'");

    if (mysqli_num_rows($result) == 0) {
        die('Company details not found');
    } elseif (mysqli_num_rows($result) == 1) {
        $r =  mysqli_fetch_assoc($result);

        if (mysqli_num_rows($a) == 0) {
            die('Invalid receipt no.');
        } elseif (mysqli_num_rows($a) > 0) {
            $an =  mysqli_fetch_assoc($a);
            $b = mysqli_query($dbc, "select * from hbl_invoice_view_1 where ReceiptNo='$an[SubjectID]'");

            if (mysqli_num_rows($b) == 0) {
                die("Transaction details not found");
            } else {
                $bn = mysqli_fetch_assoc($b);
?>
                <!DOCTYPE html>

                <html>

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>
                        <?php echo $bn['HouseBL'] . ' Handling Charges Invoice' ?>
                    </title>

                    <?php include('script.php'); ?>

                </head>
                <div class="no-print"><button><input type="text">Convert</button></div>
                <div class='bg-success m-3 div-header-footer sr-only'></div>
                <div style="height:1200px;border:5px dashed green;min-width:1080px;">
                    <table class='m-4 tbl-heading' style='width:980px;color:black'>
                        <thead>
                            <tr>
                                <td>
                                    <div class='logo'></div>
                                </td>
                                <td colspan="2">
                                    <div style='font-size: 25px;text-align:right;text-transform:uppercase;font-weight:bold;'>
                                        <span> <?php echo $r['InstName']; ?> </span><br>
                                    </div>
                                    <div style="margin-bottom:100px;font-size:16px;text-align:right;">
                                        CUSTOM BROKERS, CONSOLIDATION, SEA & AIR FREIGHT, CLEARING & FORWADING, TRANSIT, HAULAGE, IMPORT & EXPORT
                                    </div>
                                </td>
                            </tr>
                            <td colspan="4">
                                <div clas="mt-4" style="background-color: #7e4331;padding:0px;font-weight: bold;text-align:right;padding-right:140px;color:white;">
                                    <span style="color:#7e4331;font-size:3rem;background-color:white;display:inline;padding:20px 20px;">INVOICE</span>
                                </div>
                            </td>
                            <tr>
                                <?php
                                $c = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$bn[ConsigneeID]'");
                                if (mysqli_num_rows($c) <> 1) {
                                    die('System could not fetch consignee details');
                                } else {
                                    $cn = mysqli_fetch_assoc($c);
                                }
                                ?>
                                <td colspan="2">
                                    <div style='font-size: 13px;font-size:20px;' class="mt-4">
                                        <b>CLIENT DETAILS:</b><br>
                                        <span><?php echo $cn['FullName'] ?></span><br>
                                        <span><?php echo $cn['Address1'] ?></span><br>
                                        <span><?php echo $cn['Address2'] ?></span><br>
                                        <span><?php echo $cn['Address3'] ?></span><br>
                                    </div>
                                </td>
                                <td colspan="2">
                                    <div class="tbl-invoice-date">
                                        <span>Date:</span>
                                        <span><?php echo strftime("%b %d,%Y", strtotime($bn['Date'])) ?></span>
                                    </div>
                                    <div class="tbl-invoice-date" class="mt-4">
                                        <span>Invoice# :</span>
                                        <span><?php echo $bn['ReceiptNo'] ?></span>
                                    </div>
                                    <div class="tbl-invoice-date" class="mt-4">
                                        <span>BL# :</span>
                                        <span><?php echo $bn['HouseBL'] ?></span>
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="height:10px;"></div>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table class="table-striped table-bordered m-4" style='width:980px;font-size:22px;color:black;'>
                        <thead>
                            <tr class="text-center font-weight-bold bg-black text-white" style="border:0px solid black;">
                                <td colspan="3">DESCRIPTION</td>
                                <td class="text-center">TOTAL</td>
                            </tr>
                            <thead>
                            <tbody>
                                <?php
                                $b = mysqli_query($dbc, "select * from hbl_invoice_view_1 where ReceiptNo='$an[SubjectID]'");
                                while ($dn = mysqli_fetch_assoc($b)) {
                                ?>
                                    <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-center"><?php echo "Handling Charges"; ?></td>
                                        <td class="text-right"><?php echo number_format($dn['TFee'], 2, '.', ','); ?></td>
                                    </tr>
                                <?php } ?>

                                <?php
                                $e = mysqli_query($dbc, "select GTFVal,TFee,SubTotal,VATVal from hbl_invoice_view_1 where ReceiptNo='$an[SubjectID]'");
                                $en = mysqli_fetch_assoc($e);
                                ?>
                                <tr>
                                    <td colspan="3" class="text-right">GetFund+NHIL+Covid Levy(6%)</td>
                                    <td class="text-right"><?php echo number_format($en['GTFVal'], 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">New Sub Total</td>
                                    <td class="text-right"><?php echo number_format($en['SubTotal'], 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">VAT(15%)</td>
                                    <td class="text-right"><?php echo number_format($en['VATVal'], 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right fw-bold" style="text-transform:uppercase;"><b>Total Amount Payable</b></td>
                                    <td class="text-right"><b><?php echo number_format($en['TFee'] + $en['VATVal'] + $en['GTFVal'], 2, '.', ','); ?></b></td>
                                </tr>
                            </tbody>
                    </table>
                    <div style="height:10px;"></div>
                    <table class="m-4 tbl-footer-sign" style='width:980px;color:black'>
                        <tr>
                            <td colspan="2">
                                <span class="p-2 my-2 d-inline-block bg-warning">ALL CURRENCIES ARE IN GHANA CEDIS (GHC)</span>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="border-top: 3px solid gray;border-bottom:3px solid gray;">
                            <td colspan="4" style="padding-bottom:10px;">
                                <b>Ghana Address:</b> <?php echo $r['Address']; ?></span>, <span><?php echo $r['Location']; ?></span> <br>
                                <span><?php echo $r['TelNo']; ?> | <?php echo $r['Website']; ?> | <?php echo $r['Email']; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-center py-1" style="font-size:16px;color:black;font-weight:bold;">ISSUED BY:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-center" style="border-bottom:1px dotted black;font-size:16px;color:black;"><?php echo $_SESSION['FName']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-bottom:0px;padding-top:40px;text-align:center;"><b>Thank you.</b></td>
                        </tr>
                    </table>
                </div>
                <div class='bg-success m-3 div-header-footer sr-only'></div>
<?php  }
        }
    }
}
?>

                </html>

                <style>
                    * {
                        font-family: Consolas, Tahoma, Arial;
                    }

                    .tbl-heading td {
                        border: 0px solid black;
                        width: 25%;
                    }

                    .logo {
                        border: 0px solid gray;
                        background: url('<?php echo $loc; ?>/img/logo1<?php echo $logo_ext; ?>')no-repeat;
                        background-size: cover;
                    }

                    .div-header-footer {
                        width: 1000px;
                        height: 20px;
                    }

                    .tbl-footer-sign td {
                        width: 25%;
                    }

                    .tbl-invoice-date {
                        text-align: right;
                    }

                    .tbl-invoice-date span:first-child {
                        font-weight: bold;
                        font-size: 1.5rem;
                    }

                    .tbl-invoice-date span:last-child {
                        font-size: 1.2rem;
                    }

                    @media print {
                        .no-print {
                            display: none;
                        }
                    }
                </style>