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

    $result = mysqli_query($dbc, "SELECT * FROM inst_branch_view WHERE BranchID='$BranchID'");
    $a =  mysqli_query($dbc, "SELECT * FROM rpt_multi_values WHERE Username='$Uname'");

    if (mysqli_num_rows($result) == 0) {
        die('Company details not found');
    } elseif (mysqli_num_rows($result) == 1) {
        $r =  mysqli_fetch_assoc($result);

        if (mysqli_num_rows($a) == 0) {
            die('Invalid Receipt No.');

        } elseif (mysqli_num_rows($a) > 0) {

            $an =  mysqli_fetch_assoc($a);

            $b = mysqli_query($dbc, "SELECT * FROM all_income_charges_view_1 WHERE ReceiptNo='$an[Sub_ClassID]'");

            if (mysqli_num_rows($b) == 0) {

                die("Transaction details not found ");

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
                        <?= $bn['BL'] . ' Payment Receipt' ?>
                    </title>

                    <?php include('script.php'); ?>

                </head>
                <div class='bg-danger m-3 div-header-footer'></div>
                <div style="height:1200px;">
                    <table class='m-4 tbl-heading' style='width:980px;color:black;font-weight:bold;font-size:20px;'>
                        <thead>
                            <tr>
                                <td colspan='2' style='font-size:34px;'>PAYMENT RECEIPT <br><small>TIN: <b><?= $r['TIN'] ?></b><small></td>
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
                                    <div style='text-align: center;border-bottom: 1px solid black;' class="mt-4"><?= strftime("%b %d,%Y", strtotime($bn['Date'])) ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                
                                <td colspan="2">
                                    <div style='text-align: center;border-bottom: 1px solid black;' class="mt-4"><?= $bn['BL'] . ' - ' . $bn['ReceiptNo'] ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style='margin-left: 0;border-bottom: 1px solid black;width:70%;font-size:22px;'><b>FROM:</b></div>

                                </td>
                                <td></td>
                                <td>
                                    <div style='border-bottom: 1px solid black;width:70%;font-size:22px;'><b>TO:</b></div>

                                </td>

                                <td></td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div style='font-size: 18px;margin-top:0px;font-size:20px;'>
                                        <span> <?= $r['InstName']; ?> </span><br>
                                        <span><?= $r['Address']; ?></span><br>
                                        <span><?= $r['Location']; ?></span><br>
                                        <span><?= $r['TelNo']; ?></span><br>
                                    </div>
                                </td>
                                <?php
                                $c = mysqli_query($dbc, "SELECT * FROM consignee_main WHERE ConsigneeID='$bn[ConsigneeID]'");
                                if (mysqli_num_rows($c) <> 1) {
                                    die('System could not fetch consignee details');
                                } else {
                                    $cn = mysqli_fetch_assoc($c);
                                }
                                ?>
                                <td colspan="2">
                                    <div style='font-size: 18px;font-size:20px;'>
                                        <span><?= $cn['FullName'] ?></span><br>
                                        <span><?= $cn['Address1'] ?></span><br>
                                        <span><?= $cn['Address2'] ?></span><br>
                                        <span><?= $cn['Address3'] ?></span><br>
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

                    <table class="table-striped table-bordered m-4" style='width:980px;'>
                        <thead>
                            <tr class="text-center font-weight-bold bg-danger text-white" style="border:0px solid black;">
                                <td colspan="3">DESCRIPTION</td>
                                <td class="text-center">TOTAL</td>
                            </tr>
                            <thead>
                            <tbody style="font-size: 20px;font-size:22px;color:black;">
                                <?php
                                $bb = mysqli_query($dbc, "SELECT * FROM student_fee WHERE Date<='$bn[Date]' and StudentID='$bn[StudentID]' and CouponID='$bn[CouponID]' and SubClassID='$bn[SubClassID]'");
                                //if (mysqli_num_rows($bb) == 0) { ?>
                                    <!-- <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-right"><?= "Total Charges"; ?></td>
                                        <td class="text-right">0.00</td>
                                    </tr>
                                    <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-right"><?= "Amount Paid as @ 1/1/1900"; ?></td>
                                        <td class="text-right">0.00</td>
                                    </tr>
                                    <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-right"><?= "Balance B/F"; ?></td>
                                        <td class="text-right">0.00</td>
                                    </tr>
                                    <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-right"><?= "Amount Paid"; ?></td>
                                        <td class="text-right">0.00</td>
                                    </tr>
                                    <tr class="td-sttmnt-details">
                                        <td colspan="3" class="text-right"><?= "Oustanding Balance"; ?></td>
                                        <td class="text-right">0.00</td>
                                    </tr> -->
                                    <?php //} else {
                                   // $b = mysqli_query($dbc, "select round(sum(Dr),2) as TDr,round(sum(Cr),2) as TCr, round(sum(Dr)-sum(Cr),2) as BBF from student_fee WHERE Date<='$bn[Date]' and StudentID='$bn[StudentID]' and CouponID='$bn[CouponID]' and SubClassID='$bn[SubClassID]'");
                                   // while ($dn = mysqli_fetch_assoc($b)) {
                                    ?>
                                       
                                    <?php // } ?>

                                    <?php
                                    $e = mysqli_query($dbc, "select round(sum(Cr),2) as AmtPaid from student_fee WHERE ReceiptNo='$an[Sub_ClassID]'");
                                    $en = mysqli_fetch_assoc($e);
                                    ?>
                                     <tr>
                                        <td colspan="3" class="text-right border border-danger"><?= $bn['Description']; ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Amount Paid</td>
                                        <td class="text-right"><?= number_format($bn['Amount'], 2, '.', ','); ?></td>
                                    </tr>

                                    <?php
                                    $f = mysqli_query($dbc, "select round(sum(Dr)-sum(Cr),2) as BalOuts from student_fee WHERE Date<='$bn[Date]' and StudentID='$bn[StudentID]' and CouponID='$bn[CouponID]' and SubClassID='$bn[SubClassID]'");
                                    $fn = mysqli_fetch_assoc($f);
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-right">Balance Outstanding</td>
                                        <td class="text-right"><?= number_format($fn['BalOuts'], 2, '.', ','); ?></td>
                                    </tr>

                                <?php  } ?>
                            </tbody>
                    </table>
                    <div style="height:50px;"></div>
                    <table class="m-4 tbl-footer-sign" style='width:980px;font-size:22px;color:black;font-weight:bold;'>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-center" style="padding-bottom: 25px;">RECEIVED BY:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-center" style="border-bottom:1px dotted black;"><?= $_SESSION['FName']; ?></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div style='' class='bg-danger m-3 div-header-footer'></div>
                <div style="height: 0px;" class="mb-3">
                    <!-- here we call the function that makes PDF -->
                    <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="Donwload PDF">
                </div>
<?php  }
        }
    }
//}
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
                        border: 0px solid black;
                        background: url('<?= $loc; ?>/img/logo1<?= $logo_ext; ?>')no-repeat;
                        background-size: conntain;
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