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
        }
    }
}


?>

<!doctype html>

<html>

<head>
    <title>Cargo Manifestation Breakdown</title>
    <?php
    include 'script.php';
    ?>
</head>

<body style="border: 0px solid green;">
    <table class="" style="width:1000px;border: 0px solid red;margin-top: 5px;color:black;margin-left: 10px;" id="tab_customers">
        <thead>
            <tr style="font-weight:bold;border: 1px solid black;">
                <td>
                   <img src="./img/logo1.png" height="150"/> 
                </td>
                <td colspan="4" scope="col" style="text-align: center;width: 350px;" class="psi__manifest-header">
                    <div style="font-size: 30px;text-transform: uppercase;"><?php echo $bn['InstName']  ?></div>
                    <div style="font-size: 20px;"><i class='fas fa-fw fa-envelope'></i> <?php echo $bn['Address']  ?></div>
                    <div style="font-size: 20px;"><i class='fas fa-fw fa-at'></i> <?php echo $bn['Email']  ?></div>
                    <div style="font-size: 20px;"><i class='fas fa-fw fa-map-marker-alt'></i> <?php echo $bn['Location']  ?></div>
                    <div style="font-size: 25px;text-decoration: underline;font-weight:bold;margin-top:5px;">CARGO MANIFEST BREAKDOWN</div>
                </td>
            </tr>
        </thead>
        <?php
        $c = mysqli_query($dbc, "select * from manifestation_breakdown_cargo_view where MainBL='$an[Sub_ClassID]'");
        $ct = mysqli_query($dbc, "select * from container_details where BL='$an[Sub_ClassID]'");

        if (mysqli_num_rows($c) == 0) {
            die('Container details not found');
        } else {
            $cn = mysqli_fetch_assoc($c);
        }
        ?>
        <tbody>
            <tr>
                <td class="float-left">VESSEL:</td>
                <td></td>
                <td></td>
                <td class="float-right"><b><?php echo $cn['VesselName'] ?></b></td>
                <td></td>
            </tr>
            <tr>
                <td class="float-left">ETA:</td>
                <td></td>
                <td></td>
                <td class="float-right"><b><?php echo strftime("%b %d, %Y", strtotime($cn['ETA'])) ?></b></td>
                <td></td>
            </tr>
            <tr>
                <td class="float-left" colspan="5">BILL OF LADING:</td>
                <td></td>
                <td></td>
                <td class="float-right"><b><?php echo $cn['MainBL'] ?></b></td>
                <td></td>
            </tr>
            <tr>
                <td class="float-left">CONTAINER NO & SIZE:</td>
                <td></td>
                <td></td>
                <td class="float-right"><?php while ($cnt = mysqli_fetch_assoc($ct)) { ?>
                        (<b><?php echo $cnt['ContainerNo'] ?></b>/<b><?php echo $cnt['ContainerSize'] ?></b>)
                    <?php } ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="float-left" colspan="5">P.O.L.: <b><?php echo $cn['POL_Name'] ?></b></td>
                <td></td>
                <td></td>
                <td class="float-right">P.O.D: <b><?php echo $cn['POD_Name'] ?></b></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="5" class="text-white">.</td>
            </tr>
            <tr class="mbc-head-1">
                <td width='180'>HOUSE BL#</td>
                <td width='200'>CONSIGNEE</td>
                <td width='80'>PKGS</td>
                <td width='250'>DESCRIPTION OF GOODS</td>
                <td width='140'>WEIGHT (KGS) <?php echo $an['Sub_ClassID'] ?></td>
            </tr>
            <?php $d = mysqli_query($dbc, "select * from manifestation_breakdown_cargo_view where MainBL='$an[Sub_ClassID]'");
            while ($dn = mysqli_fetch_assoc($d)) { ?>
                <tr class="mbc-head-2">
                    <td class=""><b><?php echo $dn['HouseBL'] ?></b></td>
                    <td class=""><?php echo $dn['FullName'] ?> <br> <?php echo $dn['Address1'] ?><br> <?php echo $dn['Address2'] ?><br> <?php echo $dn['Address3'] ?></td>
                    <td class=""> <?php echo $dn['Package'] ?> <?php if ($dn['Package'] == 1) {
                                                                    echo $dn['Unit'];
                                                                } else {
                                                                    echo $dn['Unit'] . "S";
                                                                } ?></td>
                    <td class="">
                        <span><?php echo $dn['Description'] ?></span><br>
                        <?php
                        if ($dn['VIN'] <> '') { ?>
                            <span><?php echo $dn['VIN'] ?></span><br>
                        <?php } else {
                        }
                        ?>
                        <?php
                        if ($dn['OtherInfo'] <> '') { ?>
                            <span><?php echo $dn['OtherInfo'] ?></span>
                        <?php }
                        ?>
                    </td>
                    <td class=""><?php echo number_format($dn['Weight'], 2, '.', ',') ?></td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="5" class="text-white">.</td>
            </tr>
            <tr>
                <td colspan="5" style="border:0px solid black;text-align: right;padding-top: 40px;"><b>SIGN.............................................</b></td>
            </tr>


        </tbody>

    </table>
    <div style="height: 0px;" class="mb-3">
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

    .mbc-head-1 td {
        font-size: 18px;
        border: 1px solid black;
        text-align: center;
        font-weight: bold;
    }

    .mbc-head-2 td {
        text-align: left;
        border: 1px solid black;
        padding-left: 3px;
        text-transform: uppercase;
    }

    .psi__manifest-header .fas{
        color: #7e4430;
        font-size: 28px;
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