<?php
//start the session
session_start();

//Database connection
include 'cn/cn.php';

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);

if (!isset($_SESSION['Uname'])) {
    echo "<script>alert('You need to login. Press OK to continue.')</script>";
    echo "<script>window.location.href='login'</script>";
}

$a = mysqli_query($dbc, 'select * from t_date');
if (mysqli_num_rows($a) > 1) {
    $ActiveDate = '0';
} else {
    $an = mysqli_fetch_assoc($a);
    $ActiveDate = strftime('%d %b, %Y', strtotime($an['ActiveDate']));
}

//Set Student Ctrl and School Fee Receivable Ctrl
$fcc = mysqli_query($dbc, 'select * from ctrl_fee_receivable');
$fc1 = mysqli_fetch_assoc($fcc);
$_SESSION['fc'] = $fc1['AccountID'];

$stcc = mysqli_query($dbc, 'select * from ctrl_student');
$stc1 = mysqli_fetch_assoc($stcc);
$_SESSION['stc'] = $stc1['AccountID'];

$disbursement_auth = false;
$disbursement = mysqli_query($dbc, "SELECT * FROM disburement_user_auth");
while ($disbursement_user = mysqli_fetch_assoc($disbursement)) {
    if ($Uname === $disbursement_user['Authorisor']) {
        $disbursement_auth = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freight Pro - Front Desk</title>

    <?php include 'script.php'; ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require("_template/views/sidebar-nav.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'script_topbar.php'; ?>

                <!-- Begin Dasboard Page Content -->
                <div class="container-fluid sub-basic-setup" id="dasboard-panel">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Alert Card Template -->
                    <div class="row">
                        <?php include_once './_template/info_cards/alert_cards.php'; ?>
                    </div>

                    <!-- BL Status Templates -->
                    <?php require("_template/info_cards/bl_status_notifications.view.php"); ?>

                </div>
                <!-- /. End of Dasboard Page Content -->

                <?php include_once 'script_user_profile.php'; ?>

                <?php
                // require("_template/components/basic_setup/ledger_control.view.php");
                // require("_template/components/basic_setup/ledger_category.view.php");
                // require("_template/components/basic_setup/ledger_account.view.php");
                // require("_template/components/basic_setup/handling_charges_setup.view.php");
                // require("_template/components/basic_setup/disbursement_charges_setup.view.php");
                ?>

                <?php
                require("_template/components/consigment_register/new_consignment.view.php");
                //require("_template/components/consigment_register/assign_officer_consignment.php");

                ?>


                <?php require("_template/components/invoicing/bl_invoice.view.php"); ?>
                <?php require("_template/components/invoicing/waybill.view.php"); ?>
                <?php require("_template/components/invoicing/other_service_invoice.view.php"); ?>
                <?php require("_template/components/invoicing/non_bl_invoice.view.php"); ?>

                <?php require("_template/components/payment_transaction/receive_handling_charges.view.php"); ?>
                <?php require("_template/components/payment_transaction/process_declaration.php"); ?>
                <?php require("_template/components/payment_transaction/handling_charge_expenditure.view.php"); ?>
                <?php require("_template/components/payment_transaction/service_charge_income.view.php"); ?>

                <?php require("_template/components/ledger_transaction/expenditure_transaction.view.php");  ?>
                <?php require("_template/components/ledger_transaction/gl_transfer_double_entry.view.php"); ?>
                <?php require("_template/components/ledger_transaction/credit_income_account.view.php"); ?>
                <?php require("_template/components/ledger_transaction/debit_expenditure_account.view.php"); ?>

                <?php require("_template/components/disbursement_analysis/new_disbursement_analysis.view.php") ?>
                <?php require("_template/components/disbursement_analysis/disbursement_analysis_approval.view.php"); ?>

                <?php require("_template/components/reports/client_transaction_details_rpt.view.php"); ?>
                <?php require("_template/components/reports/accounting_report.view.php"); ?>
                <?php require("_template/components/reports/other_reports.view.php"); ?>
                <?php require("_template/components/reports/disbursement_report.view.php"); ?>

                <?php require("_template/components/edit/edit_consignment_details.view.php"); ?>
                <?php require("_template/components/edit/edit_consignment_weight.view.php"); ?>
                <?php require("_template/components/edit/reverse_transaction.view.php"); ?>

                <!-- Begin Cargo manifestation Content -->
                <div class="container-fluid sub-basic-setup" id="new-consignment-details">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Consignment Details Panel</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-sm-8 mb-2">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Consignment Search</h6>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label for="exampleFormControlInput1">Bill of Lading #</label>
                                            <label type="text" class="form-control ep" hidden='' id='cns_id_profile_search'></label>
                                            <input type="text" class="form-control form-control-user ep" id="search_consignment_profile_rpt" placeholder="Enter Bill of Laden/ Carrier/ Vessel Name" autocomplete="off">
                                            <div id='display_cns_profile_search_info' class='div_search_box'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-7 mb-2 sr-only">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Options</h6>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_profile_option_details" style="max-height: 200px;overflow-y: scroll;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-1">
                            <!-- Approach -->
                            <div class="card shadow mb-1" id="manifestation_breakdown_card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Consignment Details</h6>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cons_profile_recent_activity">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /. End of Cargo manifestation Content -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Garimo eNovations Ltd - 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require("_template/modals/logout.view.php"); ?>
    <?php require("_template/modals/pol.view.php"); ?>
    <?php require("_template/modals/shipping_line.view.php"); ?>
    <?php require("_template/modals/pod.view.php"); ?>
    <?php require("_template/modals/shipper.view.php"); ?>
    <?php require("_template/modals/consignee_notify_party.view.php") ?>
    <?php require("_template/modals/manifest_breakfast.view.php"); ?>
    <?php require("_template/modals/consignee_in_process.view.php") ?>
    <?php require("_template/modals/client_profile_invoice.view.php"); ?>
    <?php require("_template/modals/declaration_in_process.view.php"); ?>
    <?php require("_template/modals/consginment_details_profile.view.php") ?>
    <?php require("_template/modals/edit_consignment.view.php"); ?>


    <!-- This is the footer bar -->
    <?php include 'script_bottom.php'; ?>

</body>

</html>