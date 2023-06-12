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
    <title>CUSTOMER WAYBILL</title>
    <?php
    include 'script.php';
    ?>
</head>

<body class="customer-waybill">
    
    <table style="width:900px;margin-top: 5px;color:black;margin-left: 10px;">
        <thead style="border: 1px solid black;">
            <tr style="font-weight:bold;display:flex;align-items:center;justify-content:space-around">
                <td style="text-align: center;">
                    <div><img src="img/logo1.png" height="100rem" /></div>
                </td>
                <td scope="col" style="text-align: center;">
                    <div style="font-size: 18px;text-transform: uppercase;"><?php echo $bn['InstName']  ?></div>
                    <div style="font-size: 18px;"><?php echo $bn['Address']  ?></div>
                    <div style="font-size: 18px;"><?php echo $bn['Email']  ?></div>
                    <div style="font-size: 18px;"><?php echo $bn['Location']  ?></div>
                </td>
                <td>
                    <div style="display:flex;align-items:center;justify-content:center;">
                        <span style="font-size: 35px;">WAYBILL</span>
                        
                    </div>
                </td>
            </tr>
        </thead>
    </table>
        <?php
        $c = mysqli_query($dbc, "select * from waybill_main where id='$an[Value1]'");

        if (mysqli_num_rows($c) == 0) {
            die('<table class="tbl-error" style="margin-top: 50px;
            font-weight: bold;
            font-size: 24px;"><tr><td>Report details not found</td></tr></table>');
        }
        $cn = mysqli_fetch_assoc($c);

        ?>
        <table style="width:900px;margin-top: 5px;color:black;margin-left: 10px;">
        <tbody>
            <tr>
                <td><div style="border: 1xp solid red; height:20px;"></div></td>
            </tr>
            <tr class="waybill-tr">
                <td colspan="3">
                    <div class="waybill-header">
                        <div><label class="waybill-td-title">CONSIGNEE:</label> <span class="waybill-td-data"> <?php echo $cn['Consignee'] ?></span></div>
                        <div><label class="waybill-td-title">DATE:</label> <span class="waybill-td-data"> <?php echo strftime("%d/%m/%Y",strtotime($cn['WaybillDate'])) ?></span></div>
                    </div>
                    
                </td>
            </tr>
            <tr class="waybill-tr">
                <td colspan="3">
                <div class="waybill-header">
                    <div><label class="waybill-td-title">VEHICLE NO.:</label> <span class="waybill-td-data"> <?php echo $cn['VehicleNo'] ?></span></div>
                    <div><label class="waybill-td-title">DRIVER'S NAME:</label> <span class="waybill-td-data"> <?php echo $cn['DriverName'] ?></span></div>
                </div>
                </td>
            </tr>
            
            <tr class="waybill-tr">
                <td colspan="3">
                    <div class="waybill-header">
                        <div><label class="waybill-td-title">PORT:</label> <span class="waybill-td-data"> <?php echo $cn['Port'] ?></span></div>
                        <div><label class="waybill-td-title">DRIVER'S LICENSE NO.:</label> <span class="waybill-td-data"> <?php echo $cn['DriverLicense'] ?></span></div>
                    </div>
                    
                </td>
            </tr>
            

            <tr>
                <td><div style="border: 0xp solid red; height:20px;"></div></td>
            </tr>

            <tr class="waybill-body-tr">
                <td>PACKAGE</td>
                <td>DESCRIPTION</td>
                <td>QUANTITY</td>
            </tr>
            <tr class="waybill-body">
                <td><?php echo $cn['Package'] ?></td>
                <td><?php echo $cn['Description'] ?></td>
                <td><?php echo $cn['Quantity'] ?></td>
            </tr>
            <tr>
                <td><div style="border: 1xp solid red; height:20px;"></div></td>
            </tr>
            <tr class="waybill-tr">
                <td colspan="3">
                    <div class="waybill-header">
                        <div><label class="waybill-td-title">RECEIVED BY:</label> <span>.......................</span></div>
                        <div><label class="waybill-td-title">PREPARED BY:</label> <span>.................</span></div>
                    </div> 
                </td>
            </tr>
            <tr>
                <td><div style="border: 1xp solid red; height:20px;"></div></td>
            </tr>
            <tr class="waybill-tr">
                <td colspan="3">
                    <div class="waybill-header">
                        <div><label class="waybill-td-title">DRIVER'S SIGNATURE:</label> <span>..................</span></div>
                        <div><label class="waybill-td-title">SIGNATURE:</label> <span>...................</span></div>
                    </div> 
                </td>
            </tr>

            <tr>
                <td><div style="border: 1xp solid red; height:20px;"></div></td>
            </tr>

            <tr class="waybill-tr">
                <td colspan="3" style="text-align: center;font-size:40px">
                    THANK YOU 
                </td>
            </tr>

        </tbody>
    </table>
    <div style="height: 0px;" class="m-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.open('customer_waybill_printable.php')" value="PRINT VIEW">
    </div>
</body>

</html>
<style>
    body{
        box-sizing: border-box;
    }
    th,
    tr,
    td {
        border: 0px solid black;
    }
    .customer-waybill{
        font-family: 'Courier New', Courier, monospace;
        font-size: 14px;
    }
    .waybill-data{
        border-bottom: 1px dashed black;
    }
    .waybill-tr{
        margin-top: 5px;
        border: 0px solid red;
        font-size: 18px;
    }
    .waybill-tr td{
        border: 0px solid black;
        padding: 0px 10px;

    }
    .waybill-td-title{
        font-size: 14px;
        font-weight: bold;
    }
    .waybill-td-data{
        font-size: 22px;
        border-bottom: 1px dashed black;
        text-transform: uppercase;
    }
    .waybill-header{
        display: flex;
        justify-content: space-between;
        margin: 5px;
    }
    .waybill-body-tr td{
        border: 1px solid black;
        text-align: center;
        padding: 7px;
        font-size: 18px;
    }
    .waybill-body td{
        text-align: center;
        font-size: 20px;
        border: 1px solid black;
        padding: 10px 0px;
        height: 400px;
    }
    
    
    @media print {
        @page {
            size: portrait
        }
    }
</style>