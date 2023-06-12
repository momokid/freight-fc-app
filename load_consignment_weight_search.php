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
    // $b = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");

    if (mysqli_num_rows($a) == 0) {
        die('Error detected: Consignment Details not recorded.');
    } else {
        $an = mysqli_fetch_assoc($a);

        $b = mysqli_query($dbc, "select * from consignment_profile_view where BL='$an[LDate]'");

        if (mysqli_num_rows($b) == 0) {
            die('Records not found');
        } elseif (mysqli_num_rows($b) <> 1) {
            die('Multiple records detected');
        } else {
            $bn = mysqli_fetch_assoc($b);
        }
    }
}


?>


<div class="alert alert-danger text-danger font-weight-bold alert_danger_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success text-succes font-weight-bold alert_success_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div>

<table class="table table-edit-prvw">
    <thead>

    </thead>
    <tbody>
        <tr>
            <td colspan="5" class="text-center font-weight-bold">CONSIGNMENT DETAILS</td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">D.O.T.</span>
                    <br>
                    <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['Date'])); ?></span>
                    <span class="mbl-details-body sr-only" id="edit_cns_id"><?php echo $bn['ConsignmentID']; ?></span>
                </div>

            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Bill of Laden</span>
                    <br>
                    <div id="edit_cns_mbl_edit" class="form-control form-control-user edit-var-wgt"><?php echo $bn['BL']; ?></div>
                    <label hidden id="edit_cns_wwight_bl"><?php echo $bn['BL']; ?></label>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Container Size</span>
                    <br>
                    <div id="edit_cns_cnz" class="form-control form-control-user edit-var-wgt"><?php echo $bn['ContainerSize']; ?></div>
                </div>
            </td>
            <td class="mbl-details-td" colspan="2">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Gross Weight (KG)</span>
                    <br>
                    <label id="edit_cns_gwt" class="form-control form-control-user edit-var-wgt"><?php echo $bn['ContWeight']; ?></label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="5" class="text-center font-weight-bold">MANIFEST BREAKDOWN DETAILS</td>
        </tr>

        <?php

        $c = mysqli_query($dbc, "select * from manifestation_breakdown_view where MainBL='$an[LDate]' and ConsignmentID='$an[SubjectID]' ");
        if (mysqli_num_rows($c) == 0) {
            echo '<tr><td>Manifets breakdown details not found</td></tr>';
        } else {
            while ($cn = mysqli_fetch_assoc($c)) { ?>
                <tr>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Consignee</span>
                            <br>
                            <span id="edit_csn_wght_cnsid" hidden><?php echo $cn['ConsigneeID']; ?></span>
                            <div id="edit_cns_cnt" class="form-control form-control-user edit-var-wgt"><?php echo $cn['FullName']; ?></div>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">House BL#</span>
                            <br>
                            <div id="edit_cns_pos" class="form-control form-control-user edit-var-wgt"><?php echo $cn['HouseBL']; ?></div>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2 cut-text">
                            <span class="mbl-details-head">Description</span>
                            <br>
                            <div id="edit_cns_dis" class="form-control form-control-user dtp edit-var-wgt"><?php echo $cn['Description']; ?></div>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Package</span>
                            <br>
                            <div id="edit_cns_sob" class="form-control form-control-user dtp edit-var-wgt"><?php echo $cn['Package'] . $cn['Unit']; ?></div>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Weight</span>
                            <br>
                            <input type="text" bl="<?php echo $cn['MainBL'] ?>" id="<?php echo $cn['HouseBL'] ?>" class="form-control form-control-user edit-var-wgt weight-text-box" value="<?php echo $cn['Weight']; ?>">
                        </div>
                    </td>
                </tr>
        <?php   }
        }
        ?>


        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-success col-12" id="btn-update-cons-wght-details">Update Consignment Details</button>
            </td>
        </tr>
    </tbody>
</table>

<table>

</table>


<style>
    th,
    tr,
    td {
        border: 0px solid black;
        padding-left: 5px;
    }

    .table-edit-prvw .table th,
    table-edit-prvw .table td {
        border-right: 1px solid #e3e6f0;
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

    .edit-var-wgt {
        border: 1px solid green;
        border-radius: 0px;
    }

    .cut-text {
        display: block;
        width: 98%;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    div.edit-var-wgt {
        background-color: #bbb;
        color: white;
    }

    #btn-update-cons-wght-details {
        padding: 1rem;
        border-radius: 4rem;
        font-weight: bold;
    }
</style>


<script>
    $('.weight-text-box').change(function() {
        let bl = $.trim($(this).attr('bl'));
        let hbl = $.trim($(this).attr('id'));
        let wgt = $.trim($(this).val());

        if (bl == '' || hbl == '') {
            alert('Main BL or House BL not found');
            return false;
        } else {
            $.post('update_consignment_weight_temp.php', {
                bl: bl,
                hbl: hbl,
                wgt: wgt
            }, function(e) {
                if (e == 1) {
                    $('#edit_cns_gwt').load('load_consignment_total_weight_edit.php');
                    return false;
                } else {
                    alert(e);
                }
            });
        }
    })

    $('#btn-update-cons-wght-details').click(function() {
        let bl = $.trim($('#edit_cns_wwight_bl').text());
        let q = confirm('Update consigment weight?');

        if (q) {
            $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
            $.post('run_update_consginment_weight.php', {
                bl: bl
            }, function(a) {
                if (a == 1) {
                    $('.alert_success_banner').text('Consignment details updated successfully!!!').fadeIn(500).fadeOut(7000);
                    $('.progress-loader').remove();
                    $('#cons_wieght_edit_search_result').hide(2000);
                    $('#cns_id_wieght_edit_search').val('').focus();
                } else {
                    $('.progress-loader').remove();
                    $('.alert_danger_banner').text(a).append('***').fadeIn(500).fadeOut(7000);
                }
            });

        } else {
            return false;
        }

    });
</script>