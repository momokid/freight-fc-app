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
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values where Username='$Uname'");
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
            $h = mysqli_query($dbc, "select * from manifestation_breakdown_hbl_0 where ConsigneeID='$an[LDate]' and MainBL='$an[Sub_ClassID]' and HouseBL='$an[SubjectID]'");
            $hn = mysqli_fetch_assoc($h);
        }
    }
}


?>

<!doctype html>

<html>

<head>
    <title><?php echo $hn['FullName'] . " " . $hn['MainBL'] . "~" . $hn['HouseBL'] ?></title>
    <?php
    include 'script.php';
    include 'script_jspdf.php';
    ?>
</head>

<body style="border: 0px solid green;position: relative;width:1000px;">
    <div style="position:absolute;width: 100%;color: #85879626;z-index: -10;font-size: 11.5rem;margin-top: 47%;font-family:'Arial Black';transform: rotate(-50deg);">ORIGINAL</div>
    <?php
    $c = mysqli_query($dbc, "select * from manifestation_breakdown_hbl_0 where ConsigneeID='$an[LDate]' and MainBL='$an[Sub_ClassID]' and HouseBL='$an[SubjectID]'");

    if (mysqli_num_rows($c) == 0) {
        die('Invoice receipt no. not found');
    } else {
        $cn = mysqli_fetch_assoc($c);
    }
    ?>
    <table class="" style="font-family: Calibri;margin-top: 5px;color:black;margin-left: 10px;margin-top: 40px;z-index: 1; border:6px dashed #7e4430;width:1000px;"
        <tr>
            <?php $d = mysqli_query($dbc, "select * from shipper_main where ShipperID='$cn[ShipperID]'");
            if (mysqli_num_rows($d) <> 1) {
                die('Shipper details not found');
            } else {
                $en = mysqli_fetch_assoc($d);
            }
            ?>
            <td class="hbl-inv-td" colspan="2">
                <div class="div-hbl-inv-2">
                    <span class="hbl-inv-head">Shipper</span>
                    <br>
                    <span class="hbl-inv-body"><?php echo nl2br($en['ShipperName'], false); ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($en['AddressLine1'], false); ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($en['AddressLine2'], false); ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($en['AddressLine3'], false); ?></span>
                </div>

                <?php $d = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$cn[ConsigneeID]'");
                if (mysqli_num_rows($d) <> 1) {
                    die('Consignee details not found');
                } else {
                    $dn = mysqli_fetch_assoc($d);
                }
                ?>
                <div class="div-hbl-inv-2" style="border:0px solid black; border-right: 1px solid black;">
                    <span class="hbl-inv-head">Consignee</span>
                    <br>
                    <span class="hbl-inv-body"><?php echo $dn['FullName']; ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($dn['Address1'], false); ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($dn['Address2'], false); ?></span><br>
                    <span class="hbl-inv-body"><?php echo nl2br($dn['Address3'], false); ?></span>
                </div>
                <?php $d = mysqli_query($dbc, "select * from consignee_main where ConsigneeID='$cn[Consigenee2_ID]'");
                if (mysqli_num_rows($d) <> 1) {
                    die('Notify party details not found');
                } else {
                    $dn = mysqli_fetch_assoc($d);
                }
                ?>
                <?php if ($cn['ConsigneeID'] == $cn['Consigenee2_ID']) { ?>
                    <div class="div-hbl-inv-2" style='border-bottom:0px;'>
                        <span class="hbl-inv-head">Notify Party (No claim shall attach for failure to notify)</span>
                        <br>
                        <span class="hbl-inv-body"><?php echo "SAME AS CONSIGNEE"; ?></span><br>

                    </div>

                <?php } else { ?>
                    <div class="div-hbl-inv-2" style='border-bottom:0px;'>
                        <span class="hbl-inv-head">Notify Party (No claim shall attach for failure to notify)</span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $dn['FullName']; ?></span><br>
                        <span class="hbl-inv-body"><?php echo $dn['Address1']; ?></span><br>
                        <span class="hbl-inv-body"><?php echo $dn['Address2']; ?></span><br>
                        <span class="hbl-inv-body"><?php echo $dn['Address3']; ?></span>
                    </div>
                <?php  } ?>

            </td>


            <td class="hbl-inv-td" colspan="2">
                <div style="float: top;border:0px solid black;height: 450px;">
                    <div>
                        <div style="font-size: 35px;font-weight: bold;float: left;margin-right: 10px;">BILL OF LADING</div>
                        <div style="border: 1px solid black;float: left;padding-left:5px ;font-weight:bold;font-size: 14px;width: 250px;margin-top: 10px;">Bill of Lading Number <br> <?php echo $cn['HouseBL'] ?> </div>
                        <div style="background-image: url('img/psil.png'); background-size: contain; background-repeat:no-repeat;float: left;width: 100%;height: 185px;margin-top: 20px;z-index:2;"></div>
                        <div style="float: left; font-size: 12px;margin-top: 20px;font-weight:bold;padding: 10px;">Received by the carrier, the goods as specified below in apparent goods order and condition, either
                            while stated to be transported to be such place as signed, authorized or certified herein and subject
                            to all the terms and conditions appearing on the front and reverse of the bill of lading to which the
                            merchant agrees by accepting the bill of lading. Any local privileges and customs notwithstanding.
                            The particulars given below as stated by the shipper and the weight, measure, quantity, condition,
                            contents and values of the goods are unknown to the carrier.<br>
                            IN WITNESS WHEREOF the number of original Bills of Lading stated on this side have been signed
                            and wherever one original Bill of Lading has been
                            Surrendered any others shall be void.
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        <tr style="border:1px solid black;border-left: 0px;border-right: 0px;">
            <td colspan="2" style="border-right:1px solid black;">
                <?php $d = mysqli_query($dbc, "select * from container_main_view where ConsignmentID='$cn[ConsignmentID]'");
                if (mysqli_num_rows($d) == 0) {
                    die('Container details not found');
                } else {
                    $dn = mysqli_fetch_assoc($d);
                }
                ?>
                <div>
                    <span class="hbl-inv-head">Vessel</span>
                    <br>
                    <span class="hbl-inv-body"><?php echo $dn['VesselName']; ?> <?php echo $dn['VoyageNo']; ?></span><br>
                </div>
            </td>
            <td>
                <div>
                    <span class="hbl-inv-head">Port of Loading</span>
                    <br>
                    <span class="hbl-inv-body"><?php echo $dn['POL_Name']; ?></span><br>
                </div>
            </td>
            <td style="border:0px solid black; border-left: 1px solid black; width: 50px;">

            </td>
        </tr>
        <tr style="border:1px solid black;border-left: 0px;border-right: 0px;">
            <td style="border-right:1px solid black;">
                <div>
                    <span class="hbl-inv-head">Port of Discharge</span>
                    <br>
                    <span class="hbl-inv-body"><?php echo $dn['POD_Name']; ?></span><br>
                </div>
            </td>
            <td style="border-right:1px solid black;">
                <div>
                    <span class="hbl-inv-head"> Destination (if on-carriage) </span>
                    <br>
                    <span class="hbl-inv-body"></span><br>
                </div>
            </td>
            <td>
                <div>
                    <span class="hbl-inv-head">Freight payable at:</span>
                    <br>
                    <span class="hbl-inv-body"></span><br>
                </div>
            </td>
            <td style="border:0px solid black; border-left: 1px solid black;">
                <div>
                    <span class="hbl-inv-head">No of originals</span>
                    <br>
                    <span class="hbl-inv-body">0 (ZERO)</span>
                </div>
            </td>
        </tr>

        <tr style="border:0px solid black;">
            <?php $d = mysqli_query($dbc, "select * from manifestation_breakdown_cargo_view where ConsignmentID='$cn[ConsignmentID]' and MainBL='$cn[MainBL]' and HouseBL='$cn[HouseBL]' and ConsigneeID='$cn[ConsigneeID]'");
            if (mysqli_num_rows($d) <> 1) {
                die('Cargo manifest details not found' . $cn['ConsigneeID'] . ' ' . $cn['MainBL'] . ' ' . $cn['HouseBL'] . ' ' . $cn['ConsignmentID']);
            } else {
                $fn = mysqli_fetch_assoc($d);
            }
            ?>
            <td style="border-right:1px solid black;text-align: center;">
                <div>
                    <span class="hbl-inv-head">Marks and Numbers</span>
                    <br>
                    <span class="hbl-inv-body">1X<?php echo $dn['ContainerSize'] ?> PART CONT.</span><br>
                </div>
            </td>
            <td style="border-right:1px solid black;text-align: center;">
                <div>
                    <span class="hbl-inv-head"> Description of Goods </span>
                    <br>
                    <span class="hbl-inv-body"><?php echo nl2br($fn['Description'], false) ?></span><br>
                    <?php if ($fn['VIN'] <> '') { ?>
                        <span class="hbl-inv-body"><?php echo nl2br($fn['VIN'], false) ?></span><br>
                    <?php } else {
                    } ?>
                    <?php if ($fn['OtherInfo'] <> '') { ?>
                        <span class="hbl-inv-body"><?php echo nl2br($fn['OtherInfo'], false) ?></span><br>
                    <?php } else {
                    } ?>
                </div>
            </td>
            <td style="border-right:1px solid black;text-align: center;">
                <div>
                    <div class="hbl-inv-head">Gross Weight Kgs</div>
                    <br>
                    <span class="hbl-inv-body"><?php echo $fn['Weight'] ?></span><br>
                </div>
            </td>
            <td style="border:0px solid black;text-align: center;">
                <div>
                    <span class="hbl-inv-head">Measurement M<sup>3</sup></span>
                    <br>
                    <span class="hbl-inv-body text-white">0</span>
                </div>
            </td>
        </tr>

        <tr style="height: 150px;">
            <td colspan="4" class="tr-inv-4">
                <div>
                    <div>
                        <span class="hbl-inv-head"> Container </span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $hn['ContainerNo'] ?></span><br>
                    </div>
                    <div>
                        <span class="hbl-inv-head"> Seal </span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $hn['SealNo'] ?></span><br>
                    </div>
                    <div>
                        <span class="hbl-inv-head"> Type </span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $dn['ContainerSize'] ?></span><br>
                    </div>
                    <div>
                        <span class="hbl-inv-head"> Weight </span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $fn['Weight'] ?></span><br>
                    </div>
                    <div>
                        <span class="hbl-inv-head"> Packages </span>
                        <br>
                        <span class="hbl-inv-body"><?php echo $fn['Package'];
                                                    if ($fn['Package'] > 1) {
                                                        echo $fn['Unit'] . 'S';
                                                    } else {
                                                        echo $fn['Unit'];
                                                    } ?></span><br>
                    </div>
                </div>
            </td>
        </tr>

        <tr style="border:0px solid black;border-left: 0px;border-right: 0px;" colspan='2'>
            <td colspan="2" style="border:1px solid black;border-left: 0px solid black;">
                <?php $d = mysqli_query($dbc, "select * from container_main_view where ConsignmentID='$cn[ConsignmentID]'");
                if (mysqli_num_rows($d) == 0) {
                    die('Container details not found');
                } else {
                    $dn = mysqli_fetch_assoc($d);
                }
                ?>
                <div style="text-transform:uppercase;">
                    <span class="hbl-inv-head" style="text-transform:none;">Bill of lading must be surrendered to: </span>
                    <br>
                    <span class="hbl-inv-body"><?php echo $bn['InstName']; ?></span><br>
                    <span class="hbl-inv-body"><?php echo $bn['Address']; ?></span><br>
                    <span class="hbl-inv-body"><?php echo $bn['Location']; ?></span><br>
                    <span class="hbl-inv-body">TEL: <?php echo $bn['TelNo']; ?></span><br>
                    <span class="hbl-inv-body">EMAIL: <span style="text-transform:lowercase"><?php echo $bn['Email']; ?></span></span><br><br>
                </div>
            </td>
            <td style="border:0px solid black; border-left: 0px solid black; width: 50px;">

            </td>
            <td style="border:0px solid black; border-left: 0px solid black; width: 50px;">

            </td>
        </tr>
        <tr style="border:0px solid black;border-left: 0px;border-right: 0px;">
            <td style="border-right:1px solid black;" colspan="2">
                <div>
                    <span class="hbl-inv-head">Place and Date of issue:</span>
                    <br>
                    <span class="hbl-inv-body pr-4 mb-4"><?php echo $cn['POIS']; ?></span> <span class="hbl-inv-body"><?php echo strftime("%b %d, %Y", strtotime($cn['DOIS'])); ?></span><br><br>
                    <span class="hbl-inv-body">AS CARRIER</span>
                </div>
            </td>
            <td style="border:0px solid black; border-left: 0px solid black;" colspan="2">
                <div>
                    <span class="hbl-inv-head"></span>
                    <br>
                    <span class="hbl-inv-body"></span>
                </div>
            </td>
        </tr>

        <tr style="border:0px solid black;border-right: 0px;">
            <td style="border:1px solid black;border-left: 0px;">
                <div>
                    <span class="hbl-inv-head" style="margin-top:-10px;">Place of Receipt:</span>
                    <br>
                    <span class="hbl-inv-body pr-4 mb-4 text-white">.</span><br>
                    <span class="hbl-inv-body text-white">.</span>
                </div>
            </td>
            <td style="border:1px solid black;border-left: 0px;">
                <div>
                    <span class="hbl-inv-head">Shipped on Board:</span>
                    <br>
                    <span class="hbl-inv-body pr-4 mb-4 text-white">.</span><br>
                    <span class="hbl-inv-body"><?php echo strftime("%b %d, %Y", strtotime($cn['SOB'])); ?></span>
                </div>
            </td>
            <td style="border:0px solid black; border-left: 0px solid black;" colspan="2">
                <div>
                    <span class="hbl-inv-head"></span>
                    <br>
                    <span class="hbl-inv-body"></span>
                </div>
            </td>
        </tr>

        <tr style="border:0px solid black;border-right: 0px;">
            <td style="border:0px solid black; border-left: 0px solid black;" colspan="2">
                <div>
                    <span class="hbl-inv-head"></span>
                    <br>
                    <span class="hbl-inv-body"></span>
                </div>
            </td>
            <td style="border:1px solid black;text-align: center;padding-bottom: 0px;" colspan="2">
                <div>
                    <span class="hbl-inv-head"></span>
                    <span class="hbl-inv-body">CERTIFIED TRUE COPY </span><br>
                    <span class="hbl-inv-body">PLSE ACCEPT FOR PROCESSING </span><br>
                    <span class="hbl-inv-body">.........................................</span>
                </div>
            </td>
        </tr>
    </table>
    <div style="height: 0px;" class="mb-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="Donwload PDF">
    </div>

    <?php
    include 'script_jspdf.php';
    ?>
</body>

</html>
<style>
    th,
    tr,
    td {
        border: 0px solid black;
        padding-left: 5px;
    }

    .div-hbl-inv-2 {
        border: 1px solid black;
        border-left: 0px solid;
        padding-left: 5px;
        min-height: 150px;
    }

    .div-hbl-inv-3 {
        border: 1px solid black;
    }

    .hbl-inv-td {
        border: 0px solid black;
        width: 50%;
    }

    .hbl-inv-head {
        font-size: 12px;
        font-weight: bold;
    }

    .hbl-inv-body {
        font-weight: bold;
        font-size: 18px;
        text-transform: uppercase;
    }

    .tr-inv-4 div {
        float: left;
        padding-right: 40px;
    }

    @media print {
        @page {
            size: portrait
        }
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
    $('#btn_view_invoice_rcpt').click(function() {
        window.open("invoice_housebl_charges.php", "_blank");
    });
</script>