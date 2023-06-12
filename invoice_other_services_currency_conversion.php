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
    $crn = mysqli_query($dbc, "select * from currency_conversion");

    $cr = mysqli_fetch_assoc($crn);
    $Rate = $cr['Rate'];
    if ($Rate == '0.00') {
        $Rate = 1;
    }

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
                        <?php echo $bn['FullName'] . ' Handling Charges Invoice #' . $bn['ReceiptNo']; ?>
                    </title>

                    <?php include('script.php'); ?>

                </head>

                <body>
                    <div class='bg-success m-3 div-header-footer'></div>
                    <div style="height:1200px;">
                        <table class='m-4 tbl-heading' style='width:980px;'>
                            <thead>
                                <tr>
                                    <td style='font-size:28px;'>CLIENT INVOICE</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div style="margin-left: 35%;" class='logo'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div style='text-align: center;border-bottom: 1px solid gray;' class="mt-4"><?php echo strftime("%b %d,%Y", strtotime($bn['Date'])) ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div style='text-align: center;border-bottom: 1px solid gray;' class="mt-4"><?php echo $bn['HouseBL'] . ' - ' . $bn['ReceiptNo'] ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style='margin-left: 0;border-bottom: 1px solid gray;width:70%;'><b>FROM:</b></div>

                                    </td>
                                    <td></td>
                                    <td>
                                        <div style='border-bottom: 1px solid gray;width:70%;'><b>TO:</b></div>

                                    </td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style='font-size: 13px;margin-top:-20px;'>
                                            <span> <?php echo $r['InstName']; ?> </span><br>
                                            <span><?php echo $r['Address']; ?></span><br>
                                            <span><?php echo $r['Location']; ?></span><br>
                                            <span><?php echo $r['TelNo']; ?></span><br>
                                        </div>
                                    </td>
                                    <td></td>
                                    <?php
                                    $c = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$bn[ConsigneeID]'");
                                    if (mysqli_num_rows($c) <> 1) {
                                        die('System could not fetch consignee details');
                                    } else {
                                        $cn = mysqli_fetch_assoc($c);
                                    }
                                    ?>
                                    <td>
                                        <div style='font-size: 13px;'>
                                            <span><?php echo $cn['FullName'] ?></span><br>
                                            <span><?php echo $cn['Address1'] ?></span><br>
                                            <span><?php echo $cn['Address2'] ?></span><br>
                                            <span><?php echo $cn['Address3'] ?></span><br>
                                        </div>
                                    </td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="height:100px;"></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <table class="table-striped table-bordered m-4" style='width:980px;'>
                            <thead>
                                <tr class="text-center font-weight-bold bg-success text-white" style="border:0px solid black;">
                                    <td colspan="3">DESCRIPTION</td>
                                    <td class="text-center">TOTAL</td>
                                </tr>
                                <thead>
                                <tbody>
                                    <?php
                                    $b = mysqli_query($dbc, "select * from hbl_invoice_view_0_0 where ReceiptNo='$an[SubjectID]'");
                                    while ($dn = mysqli_fetch_assoc($b)) {
                                        $Fee = round($dn['Fee'] / $Rate, 2);
                                    ?>
                                        <tr class="td-sttmnt-details">
                                            <td colspan="3" class="text-center"><?php echo $dn['Description']; ?></td>
                                            <td class="text-right"><?php echo number_format($Fee, 2, '.', ','); ?></td>
                                        </tr>
                                    <?php } ?>

                                    <?php
                                    $ee = mysqli_query($dbc, "select round(sum(Fee),2) as Total from hbl_invoice_view_0_0 where ReceiptNo='$an[SubjectID]'");
                                    $e1n = mysqli_fetch_assoc($ee);
                                    $Total = round($e1n['Total'] / $Rate, 2);
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td class="text-right"><?php echo number_format($Total, 2, '.', ','); ?></td>
                                    </tr>

                                    <?php
                                    $e = mysqli_query($dbc, "select GTFVal,TFee,SubTotal,VATVal from hbl_invoice_view_1 where ReceiptNo='$an[SubjectID]'");
                                    $en = mysqli_fetch_assoc($e);

                                    $GTFV = round($en['GTFVal'] / $Rate, 2);
                                    $SUBTotal = round($en['SubTotal'] / $Rate, 2);
                                    $VATVal = round($en['VATVal'] / $Rate, 2);
                                    $GTotal = round(($en['TFee'] + $en['VATVal'] + $en['GTFVal']) / $Rate, 2);
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-right">GetFund+NHIL(5%)</td>
                                        <td class="text-right"><?php echo number_format($GTFV, 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Sub Total</td>
                                        <td class="text-right"><?php echo number_format($SUBTotal, 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">VAT(12.5%)</td>
                                        <td class="text-right"><?php echo number_format($VATVal, 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Total Amount Payable</td>
                                        <td class="text-right"><?php echo number_format($GTotal, 2, '.', ','); ?></td>
                                    </tr>
                                </tbody>
                        </table>
                        <div style="height:50px;"></div>
                        <table class="m-4 tbl-footer-sign" style='width:980px;'>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center" style="padding-bottom: 25px;">APPROVED AND AUTHORISED BY:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center" style="border-bottom:1px dotted black;"><?php echo $_SESSION['FName']; ?></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <span class="ml-3 font-weight-bold">All Charges are in <?php echo $cr['Currency']; ?></span>
                    <div class='bg-success ml-3 div-header-footer'></div>
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

                    @media print {
                        .no-print {
                            display: none;
                        }
                    }
                </style>
                <script src="vendor/jquery/jquery.min.js"></script>
                <script>
                    $('#btn-convert-val').click(function() {
                        let crt = $.trim($('#convert-val').val());

                        if (crt == '') {
                            return false;
                        } else {
                            $.post('add_temp_currency.ph', {
                                crt: crt
                            }, function(a) {

                            });
                        }
                    });
                </script>