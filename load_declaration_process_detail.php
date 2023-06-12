<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');



$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$id = mysqli_real_escape_string($dbc, $_GET['id']);


if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM declaration_main_view where DeclarationNo='$id'");
    // $b = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");

    if (mysqli_num_rows($a) == 0) {
        die('Error detected: Declaration details not found');
    }

    $an = mysqli_fetch_assoc($a);
}


?>

<div style="position:absolute;width: 100%;color: #d8d9dc26;z-index: 100;font-size: 7rem;margin-top: -9%;font-family:'Arial Black';transform: rotate(-40deg);">PREVIEW</div>

<table class="table table-bordered">
    <thead>

    </thead>
    <tbody>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Date of transaction</span>
                    <br>
                    <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($an['Date'])); ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">DECLARATION #</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['DeclarationNo']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">BL/ HBL</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['BL']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td" colspan="2">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">ITEM DESCRIPTION</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['ItemDescription']; ?></span>
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">CONTAINER SIZE</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['ContainerSize']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">DUTY PAID</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['DutyPaid']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">AGENT NAME</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['AgentName']; ?></span>
                </div>
            </td>
            <td colspan="2" class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">AGENT CONTACT</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['AgentContact']; ?></span>
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">USERNAME</span>
                    <br>
                    <span class="mbl-details-body"><?php echo $an['FullName']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head"></span>
                    <br>
                    <span class="mbl-details-body"><?php echo $bn['POIS']; ?></span>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head"></span>
                    <br>
                    <span class="mbl-details-body"></span>
                </div>
            </td>
        </tr>

    </tbody>


</table>
<div style="height: 0px;" class="mb-3 sr-only">
    <!-- here we call the function that makes PDF -->
    <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="Donwload PDF">
    <input class="btn btn-primary no-print" type="button" value="View Invoice" id="btn_view_invoice_rcpt">
</div>

<style>
    th,
    tr,
    td {
        border: 0px solid black;
        padding-left: 5px;
    }

    .div-mbl-view-2 {
        padding-left: 5px;
        min-height: 20px;
    }

    .div-mbl-details-3 {
        border: 1px solid black;
    }

    .mbl-details-td {
        border: 0px solid black;
    }

    .mbl-details-head {
        font-size: 12px;
        font-weight: bold;
    }

    .mbl-details-body {
        font-weight: bold;
        font-size: 18px;
    }

    .prvw-manifest-breakdown {
        cursor: pointer;
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

    $('.prvw-manifest-breakdown').click(function() {
        let mbl = $.trim($(this).attr('id'));

        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php', {
            cid: mbl
        }, function(a) {
            if (a == 1) {
                window.open("rpt_manifestation_breakdown_consignee.php", "_blank");
                $('.progress-loader').remove();
            } else {
                $('.progress-loader').remove();
                alert(a);
                return false;
            }
        });
    });
</script>