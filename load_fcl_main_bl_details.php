<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns =  (trim(mysqli_real_escape_string($dbc, $_POST['cns'])));
$mbl =  (trim(mysqli_real_escape_string($dbc, $_POST['mbl'])));


if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $b = mysqli_query($dbc, "SELECT * FROM container_main WHERE BL='$mbl' AND Status=0");

    if (mysqli_num_rows($b) > 0) { ?>

        <table class='table table-bordered table-stripered' style='padding:0px;'>
            <thead class='thead-dark'>
                <tr>
                    <em>Disbursement already captured for <b><?= $mbl; ?></b></em>
                </tr>
            </thead>
            <tbody>

            <?php } else {

            $a = mysqli_query($dbc, "SELECT * FROM container_main_view_3 WHERE BL='$mbl'"); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">CONSIGNEE</th>
                                <th scope="col">BL</th>
                                <th scope="col">CONTAINER#</th>
                                <th scope="col">OFFICER</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (mysqli_num_rows($a) > 0) {
                                while ($an = mysqli_fetch_assoc($a)) { ?>

                                    <tr>
                                        <td scope="col"><?= $an['ConsigneeName'] ?></td>
                                        <td scope="col"><?= $an['BL'] ?></td>
                                        <td scope="col"><?= $an['ContainerNo'] ?></td>
                                        <td scope="col"><?= $an['OfficerAssignedName'] ?></td>
                                        <td scope="col"><i class="fa fa-download fa-lg text-primary get_disbursement" mbl="<?= $an['BL'] ?>" consigneeID="<?= $an['ConsigneeID'] ?>" hbl="<?= $an['HouseBL'] ?>" containerNo="<?= $an['ContainerNo'] ?>" title="Download disbursement account"></i></td>
                                    </tr>

                            <?php      }
                            } ?>

                        </tbody>
                    </table>
                </div>
        <?php   }
    }
        ?>

        <style>
            .thead-lig {
                background: green;
                color: white;
            }

            .table-r0:hover {
                background: black;
                color: white;
                cursor: pointer;
            }

            .fa:hover {
                cursor: pointer;
            }
        </style>

        <script>
            $(document).ready(function() {

                $('.get_disbursement').click(function() {

                    const hbl = $.trim($(this).attr('mbl'));
                    const consigneeID = $.trim($(this).attr('consigneeID'));
                    const containerNo = $.trim($(this).attr('containerNo'));
                    const mbl = $.trim($(this).attr('mbl'));

                    // $("#disbursement-analysis-panel").append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');

                    $.post('fetch_disbursement_expense_accounts.php', {
                        mbl,
                        hbl,
                        consigneeID,
                        containerNo
                    }, function(data) {
                        let result = JSON.parse(data);
                        if (result.status_code === 201) {

                            $.post('fetch_disbursement_expense_accounts_table.php', {
                                mbl,
                                hbl,
                                consigneeID
                            }, function(result) {

                                $('#disbursement_fcl_account_display').html(result);
                            })

                            console.log(result.msg)
                        } else {
                            alert(result.msg);
                        }
                        $(".progress-loader").remove();
                    })
                })
            });
        </script>