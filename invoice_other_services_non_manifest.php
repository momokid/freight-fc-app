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
            $b = mysqli_query($dbc, "select * from hbl_invoice_view_0_1 where ReceiptNo='$an[SubjectID]'");

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
                        <?php echo $bn['FullName'] . '  Invoice #' . $bn['ReceiptNo']; ?>
                    </title>

                    <?php include('script.php'); ?>

                </head>

                <body>
                    <div class="no-print"><button id="btn-convert-val">Convert</button> <input type='number' id="convert-val" placeholder="Conversion Rate"> <input type='text' id="conversion-currency" placeholder="USD, EUR, CFA"></div>
                    <div class="bg-original">
                        <table class='m-4 tbl-heading' style='width:980px;'>
                            <thead>
                                <tr>
                                    <td>
                                        <div class='logo'></div>
                                    </td>
                                    <td></td>
                                    <td colspan="2" style="text-align:right;width:130px;">
                                        <div style='font-size: 25px;margin-top:0px;text-transform:uppercase;font-weight:bold;'>
                                            <span> <?php echo $r['InstName']; ?> </span><br>
                                        </div>
                                        <div style="margin-bottom:100px;">
                                            CUSTOM BROKERS, CONSOLIDATION, SEA & AIR FREIGHT, CLEARING & FORWADING, TRANSIT, HAULAGE, IMPORT & EXPORT
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div clas="mt-4" style="background-color: #016a3f;padding:0px;font-weight: bold;text-align:right;padding-right:140px;color:white;">
                                            <span style="color:#016a3f;font-size:3rem;background-color:white;display:inline;padding:20px 20px;">INVOICE</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        $c = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$bn[ConsigneeID]'");
                                        if (mysqli_num_rows($c) <> 1) {
                                            die('System could not fetch consignee details');
                                        } else {
                                            $cn = mysqli_fetch_assoc($c);
                                        }
                                        ?>

                                        <div style='font-size: 18px;margin-top:20px;'>
                                            <label style="font-size:1.4rem;text-transform:uppercase;font-weight:bold;">Invoice To;</label><br>
                                            <span><b></b><?php echo $cn['FullName'] ?></span><br>
                                            <span><b></b><?php echo $cn['Address1'] ?></span><br>
                                            <span><?php echo $cn['Address2'] ?></span><br>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> </td>
                                    <td>
                                        <div class="tbl-invoice-date" class="mt-4">
                                            <span>Date:</span>
                                            <span><?php echo strftime("%b %d,%Y", strtotime($bn['Date'])) ?></span>
                                        </div>
                                        <div class="tbl-invoice-date" class="mt-4">
                                            <span>Invoice #:</span>
                                            <span><?php echo  $bn['ReceiptNo'] ?></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div style='border-bottom: 1px solid gray;width:70%;' class="sr-only"><b>TO:</b></div>

                                    </td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                    </td>
                                    <td colspan="2">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="height:10px;"></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <div style="text-align: left;font-size:24px;font-weight:bold;display:inline-block;width:980px;">ITEM: <b><?php echo $bn['ItemDescription'] ?></b></div>
                        <table class="m-4 table-striped" style='width:980px;font-size:1.5rem'>
                            <thead>
                                <tr class="text-center font-weight-bold tbl-header p-4">
                                    <td colspan="2">
                                        <div>DESCRIPTION</div>
                                    </td>
                                    <td class="text-center">
                                        <div>AMOUNT (GHC)</div>
                                    </td>
                                    <td class="text-center">

                                    </td>
                                </tr>
                                <thead>
                                <tbody class="content-tbl">
                                    <?php
                                    $b = mysqli_query($dbc, "select * from hbl_invoice_view_0_1 where ReceiptNo='$an[SubjectID]' order by Time asc");
                                    while ($dn = mysqli_fetch_assoc($b)) {
                                    ?>
                                        <tr class="td-sttmnt-details">
                                            <td colspan="2" class="text-center" style="text-transform: uppercase;"><?php echo $dn['AccountName']; ?></td>
                                            <td class="text-right"><?php echo number_format($dn['Fee'], 2, '.', ','); ?></td>
                                            <!-- <td class="text-right"><?php echo number_format($dn['GetVal'] + $dn['VATVal'], 2, '.', ','); ?></td> -->
                                        </tr>
                                    <?php } ?>

                                    <?php

                                    $e = mysqli_query($dbc, "select sum(Fee) as TFee, sum(VATVal) as TVal, sum(GetVal) as TGetF from hbl_invoice_view_0_1 where ReceiptNo='$an[SubjectID]' and GetFundNHIL>0 and VAT>0");
                                    $f = mysqli_query($dbc, "select sum(Fee) as TFee, sum(VATVal) as TVal, sum(GetVal) as TGetF from hbl_invoice_view_0_1 where ReceiptNo='$an[SubjectID]'");

                                    $en = mysqli_fetch_assoc($e);
                                    $fn = mysqli_fetch_assoc($f);

                                    $GetFund = round($en['TFee'] * 0.025, 2);
                                    $NHIL = round($en['TFee'] * 0.025, 2);
                                    $Covid = round($en['TFee'] * 0.01, 2);
                                    ?>
                                    <tr>
                                        <td colspan="2" class="text-right">Sub Total</td>
                                        <td class="text-right" style="font-weight: bold;"><?php echo number_format($fn['TFee'], 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="2" class="text-right">GetFund+NHIL+Covid Levy(6%)</td>
                                        <td class="text-right"><?php echo number_format($fn['TGetF'], 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">New Subtotal</td>
                                        <td class="text-right"><?php echo number_format($fn['TGetF'] + $fn['TFee'], 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">VAT (15%)</td>
                                        <td class="text-right"><?php echo number_format($en['TVal'], 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="2" class="text-right">GetFUND (2.5%)</td>
                                        <td class="text-right"><?php echo number_format($GetFund, 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">NHIL (2.5%)</td>
                                        <td class="text-right"><?php echo number_format($NHIL, 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">Covid-19 LEVY (1%)</td>
                                        <td class="text-right"><?php echo number_format($Covid, 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">VAT (15%)</td>
                                        <td class="text-right"><?php echo number_format($en['TVal'], 2, '.', ','); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr class="tbl-invoice-total">
                                        <td colspan="2" class="text-right"><b style="text-transform: uppercase;">Total Amount Payable</b></td>
                                        <td class="text-right"><b><?php echo number_format($fn['TFee'] + $en['TVal'] + $en['TGetF'], 2, '.', ','); ?></b></td>
                                        <td class="text-right"></td>
                                    </tr>

                                </tbody>
                        </table>

                        <div style="height:0px;"></div>
                        <table class="m-4 tbl-footer-sign" style='width:980px;font-size:16px'>
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
                                <td colspan="2" class="text-center" style="padding-top:20px;"><b>ISSUED BY:</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center" style="border-bottom:1px dotted black;padding-top: 15px;"><?php echo $_SESSION['FName']; ?></td>
                                <td></td>
                            </tr>
                            <tr style="border-top: 0px solid gray;border-bottom:0px solid gray;">
                                <td colspan="4" style="padding-bottom:0px;padding-top:40px;text-align:center;"><b>Thank you.</b></td>
                            </tr>
                        </table>
                    </div>
                    <div class='bg-success m-3 div-header-footer'></div>
    <?php  }
        }
    }
}
    ?>
                </body>

                </html>

                <style>
                    * {
                        font-family: Consolas, Tahoma, Arial;
                        padding: 0px;
                        margin: 0px;
                        color: black;
                    }

                    .logo {
                        border: 0px solid gray;
                        background: url('<?php echo $loc; ?>/img/logo1<?php echo $logo_ext; ?>')no-repeat;
                        background-size: cover;
                    }

                    .div-header-footer {
                        width: 1000px;
                    }

                    .top_first_header {
                        width: 200px;
                        background-color: black;
                        color: white;
                        line-height: 2.3rem;
                        font-size: 22px;
                        padding-left: 20px;
                        font-weight: bold;
                        display: inline-block;
                    }

                    .top_second_header {
                        width: 800px;
                        background-color: #6c32ca;
                        color: black;
                        line-height: 2.3rem;
                        font-size: 22px;
                        text-align: center;
                        font-weight: bold;
                        display: inline-block;
                    }

                    .tbl-footer-sign td {
                        width: 25%;
                    }

                    .tbl-header td {
                        padding: 0px;
                    }

                    .tbl-header td div {
                        background-color: black;
                        color: white;
                        display: block;
                        padding: 0px;
                    }

                    .bg-original {
                        min-height: 1200px;
                        width: 1080px;
                        border: 5px dashed green;
                    }

                    .tbl-invoice-total {
                        font-size: 24px;
                    }

                    .bg-original::before {
                        content: "ORIGINAL";
                        color: #d2cfcf;
                        font-size: 180px;
                        display: inline-block;
                        position: absolute;
                        top: 50%;
                        left: 5%;
                        -webkit-transform: rotate(40deg);
                        -moz-transform: rotate(40deg);
                        -o-transform: rotate(40deg);
                        transform: rotate(-50deg);
                        z-index: -1;
                        display: none;
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

                        .bg-original {
                            min-height: 1200px;
                            width: 1080px;
                        }
                    }
                </style>
                <script src="vendor/jquery/jquery.min.js"></script>
                <script>
                    $('#btn-convert-val').click(function() {
                        let crt = $.trim($('#convert-val').val());
                        let crn = $.trim($('#conversion-currency').val());

                        if (crt == '') {
                            alert('Enter Conversion Rate');
                            return false;
                        } else if (crn == '') {
                            alert('Enter Conversion Currency');
                            return false;
                        } else {
                            $.post('add_temp_currency.php', {
                                crt: crt,
                                crn: crn
                            }, function(a) {
                                var win = window.open();
                                win.location = "invoice_other_services_currency_conversion.php", "_blank";
                                win.opener = null;
                                win.blur();
                                window.focus();
                            });
                        }
                    });
                </script>