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
                        <?php echo $bn['FullName'] . ' Handling Charges Invoice #' . $bn['ReceiptNo']; ?>
                    </title>

                    <?php include('script.php'); ?>

                </head>

                <body style="color: black;  border:4px solid black;">
                    <div class="no-print"><button id="btn-convert-val">Convert</button> <input type='number' id="convert-val" placeholder="Conversion Rate"> <input type='text' id="conversion-currency" placeholder="USD, EUR, CFA"></div>
                    <div class='bg-success m-3 div-header-footer'></div>
                    <div style="height:1200px;">
                        <table class='m-4 tbl-heading' style='width:980px;'>
                            <thead>
                                <tr>
                                    <td colspan="2" style='font-size:34px;'>INVOICE <br><small>TIN: <b>C0015786307</b><small></td>
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
                                        <div style='text-align: center;border-bottom: 1px solid gray;' class="mt-4"><?php echo strftime("%b %d,%Y", strtotime($ajaxDate)) ?></div>
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
                                    <td colspan="2">
                                        <div style='font-size: 18px;margin-top:0px;'>
                                            <span> <?php echo $r['InstName']; ?> </span><br>
                                            <span><?php echo $r['Address']; ?></span><br>
                                            <span><?php echo $r['Location']; ?></span><br>
                                            <span><?php echo $r['TelNo']; ?></span><br>
                                        </div>
                                    </td>
                                    <?php
                                    $c = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$bn[ConsigneeID]'");
                                    if (mysqli_num_rows($c) <> 1) {
                                        die('System could not fetch consignee details');
                                    } else {
                                        $cn = mysqli_fetch_assoc($c);
                                    }
                                    ?>
                                    <td colspan="2">
                                        <div style='font-size: 18px;'>
                                            <span><?php echo $cn['FullName'] ?></span><br>
                                            <span><?php echo $cn['Address1'] ?></span><br>
                                            <span><?php echo $cn['Address2'] ?></span><br>
                                            <span><?php echo $cn['Address3'] ?></span><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="height:100px;"></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <table class="table-striped table-bordered m-4" style='width:980px;font-size:20px'>
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
                                    ?>
                                        <tr class="td-sttmnt-details">
                                            <td colspan="3" class="text-center"><?php echo $dn['Description']; ?></td>
                                            <td class="text-right"><?php echo number_format($dn['Fee'], 2, '.', ','); ?></td>
                                        </tr>
                                    <?php } ?>

                                    <?php
                                    $ee = mysqli_query($dbc, "select round(sum(Fee),2) as Total from hbl_invoice_view_0_0 where ReceiptNo='$an[SubjectID]'");
                                    $e1n = mysqli_fetch_assoc($ee);
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td class="text-right"><?php echo number_format($e1n['Total'], 2, '.', ','); ?></td>
                                    </tr>

                                    <?php
                                    $e = mysqli_query($dbc, "select GTFVal,TFee,SubTotal,VATVal from hbl_invoice_view_1 where ReceiptNo='$an[SubjectID]'");
                                    $en = mysqli_fetch_assoc($e);
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-right">GetFund+NHIL(5%)</td>
                                        <td class="text-right"><?php echo number_format($en['GTFVal'], 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Sub Total</td>
                                        <td class="text-right"><?php echo number_format($en['SubTotal'], 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">VAT(12.5%)</td>
                                        <td class="text-right"><?php echo number_format($en['VATVal'], 2, '.', ','); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Total Amount Payable</td>
                                        <td class="text-right"><?php echo number_format($en['TFee'] + $en['VATVal'] + $en['GTFVal'], 2, '.', ','); ?></td>
                                    </tr>
                                </tbody>
                        </table>
                        <div style="height:50px;"></div>
                        <table class="m-4 tbl-footer-sign" style='width:980px;font-size:20px'>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center" style="padding-bottom: 25px;">ISSUED BY:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-center" style="border-bottom:1px dotted black;"><?php echo $_SESSION['FName']; ?></td>
                                <td></td>
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