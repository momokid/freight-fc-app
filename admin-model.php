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
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Model - Freight Diary</title>

  <?php include 'script.php'; ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin-model">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-ship"></i>
        </div>
        <div class="sidebar-brand-text mx-3">P.S.I.L</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="admin-model">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        SETUP & CONFIG
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Basic Setup</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner">
            <h6 class="collapse-header sr-only">Custom Components:</h6>
            <a class="collapse-item" id="ledger_control_panel">Ledger Control</a>
            <a class="collapse-item" id="ledger_control_category_panel">Ledger Category</a>
            <a class="collapse-item" id="ledger_control_account_panel">Ledger Account</a>
            <a class="collapse-item" id="handling_charges_setup_tab">Handling Charges Setup</a>
            <a class="collapse-item" id="disbursement_charges_setup_tab">Disbursement Setup</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Consignment Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsignment" aria-expanded="true" aria-controls="collapseConsignment">
          <i class="fas fa-fw fa-dolly"></i>
          <span>Consignment Register</span>
        </a>
        <div id="collapseConsignment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <h6 class="collapse-header sr-only">Consignment Utilities:</h6>
            <a class="collapse-item" id="new-consignment-tab">New Consignment</a>
            <a class="collapse-item" id="new-cargo-manifestation-tab">Cargo Manifest</a>

          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        General Transactions
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-file-invoice-dollar"></i>
          <span>Generate Invoice</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="new-house-bl-invoice-tab">House BL Invoice</a>
            <a class="collapse-item" id="new-customer-waybill">Customer Waybill</a>
            <a class="collapse-item" id="new-other-serv-invoice-tab">Other Serv. Invoice</a>
            <a class="collapse-item" id="new-non-manifest-invoice-tab">Non-Manifest Invoice</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>



      <?php $exp_q = mysqli_query(
        $dbc,
        "select * from user_expense_petty_cash where Username='$Uname'"
      ); ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#OtherTransPages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-money-bill-alt"></i>
          <span>Payment Transactions</span>
        </a>
        <div id="OtherTransPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="rcv-process-decalartion-tab">Process Declaration</a>
            <a class="collapse-item" id="rcv-invoice-charge-tab">Receive Handl. Charge</a>
            <a class="collapse-item" id="rcv-service-charge-tab">Receive Service Charge</a>
            <a class="collapse-item" id="pay-invoice-charge-tab">Handl. Charge Expense</a>
            <?php if (mysqli_num_rows($exp_q) == 1) {
              echo ' <a class="collapse-item" id="expense-transaction-tab">Expenditure Transaction</a>';
            } ?>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#LedgerTransactions" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-money-bill"></i>
          <span>Ledger Transaction</span>
        </a>
        <div id="LedgerTransactions" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="singleEntryTransaction_GL">G.L. Transfer (Sngl Entry)</a>
            <a class="collapse-item" id="transaction_GL">G.L. Transfer (Dbl Entry)</a>
            <a class="collapse-item" id="drGlCrIncometab">Dr G.L. - Cr Income</a>
            <a class="collapse-item" id="crGlDrExpensetab">Cr G.L. - Dr Expense</a>
            <a class="collapse-item" id="expense-transaction-tab">Cr G.L. - Dr Income</a>
            <a class="collapse-item" id="expense-transaction-tab">Dr G.L. - Cr Expense</a>

            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#disbursement-panel" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-layer-group"></i>
          <span>Disbursement Analysis</span>
        </a>
        <div id="disbursement-panel" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="new-disbursement-fcl-tab">FCL</a>
            <a class="collapse-item" id="new-disbursement-lcl-tab">LCL1</a>
            <a class="collapse-item" id="new-disbursement-approval-review-tab">Approval Review</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>


      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Edit Panel
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#EditDataTab" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-user-edit"></i>
          <span>Edit Data</span>
        </a>
        <div id="EditDataTab" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="edit-consigment-details">Edit Consignment</a>
            <a class="collapse-item" id="edit-consigment-weight">Edit Weight</a>
            <a class="collapse-item" id="reverse-transaction">Reverse Transaction</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        System Report
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#ReportViewTab" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-table"></i>
          <span>Report Viewer</span>
        </a>
        <div id="ReportViewTab" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-success py-2 collapse-inner rounded">
            <a class="collapse-item" id="rpt-consigment-details">Consignment Details</a>
            <a class="collapse-item" id="rpt-client-trans-details">Client Trans. Details</a>
            <a class="collapse-item" id="rpt-accounting-report">Transaction Report</a>
            <a class="collapse-item" id="rpt-other-report">Other Report</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Chart Display
      </div>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

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

          <!-- Content Row -->
          <div class="row">
            <?php include_once './_template/info_cards/alert_cards.php'; ?>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">BL Per Month</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4 sr-only">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration Service <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->
              <div class="row sr-only">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4 sr-only">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4 sr-only">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of Dasboard Page Content -->

        <?php include_once 'script_user_profile.php'; ?>

        <!-- Begin Ledger Control Page Content -->
        <div class="container-fluid sub-basic-setup" id="ledger-control-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ledger Control Setup</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">New Ledger Category</h6>
                </div>
                <div class="card-body">
                  <form class="user">
                    <div class="form-group row sr-only">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Category ID</label>
                        <label class="form-control form-control-user label-form-control-user" id="newledgerCtryID">101191</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Control Name</label>
                        <input type="text" class="form-control form-control-user ep" id="txt-newCtryName">
                      </div>
                    </div>
                    <a href="#" class="btn btn-success btn-user btn-block" id="btn-new-control-ledger">
                      Add New Ledger Category
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Existing Ledger Control</h6>
                </div>
                <div class="card-body" id="display_new_control_ledger">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of  Ledger Control Page Content -->

        <!-- Begin Ledger Category Page Content -->
        <div class="container-fluid sub-basic-setup" id="ledger-control-category-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ledger Control Category</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">New Ledger Category</h6>
                </div>
                <div class="card-body">
                  <form class="user">
                    <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
                        <label for="exampleFormControlInput1">Category ID</label>
                        <label class="form-control form-control-user label-form-control-user" id="newledgerControlID">101191</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Category Name</label>
                        <input type="text" class="form-control form-control-user ep" id="txt-newControlName">
                      </div>
                    </div>
                    <a href="#" class="btn btn-success btn-user btn-block" id="btn-new-control-ledger">
                      Add New Category
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Existing Ledger Cateory</h6>
                </div>
                <div class="card-body" id="display_new_control_ledger">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of  Ledger Category Content -->

        <!-- Begin Ledger Category Page Content -->
        <div class="container-fluid sub-basic-setup" id="handling_charges_setup_panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Default Handling Charges</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Handling Charge Setup</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_HandlingCharge_account">
                        <option></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="txt-handlingChanrgeAmt">
                    </div>
                  </div>

                  <form class="user">
                    <a class="btn btn-success btn-user btn-block" id="btn-new-handling-charge">
                      Add Handling Charges
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Handling Charges</h6>
                </div>
                <div class="card-body" id="display_handling_charges">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of  Ledger Category Content -->

        <!-- Begin Ledger Category Page Content -->
        <div class="container-fluid sub-basic-setup" id="disbursement_charges_setup_panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Default Disbursement Charges</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disbursement Charge Setup</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_disbursement_account">
                        <option></option>
                      </select>
                    </div>
                  </div>

                  <form class="user">
                    <a class="btn btn-success btn-user btn-block" id="btn-new-disbursement-charge">
                      Add Account
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Mapped Accounts</h6>
                </div>
                <div class="card-body" id="display_disbursement_mapped_account">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of  Ledger Category Content -->


        <!-- Begin Ledger Account Page Content -->
        <div class="container-fluid sub-basic-setup" id="ledger-control-account-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ledger Account</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">New Ledger Account</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
                      <label for="exampleFormControlInput1">Ledger Account ID</label>
                      <label class="form-control form-control-user label-form-control-user" id="newledgerAccountID"></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Ledger Control</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_LedgerContrl">
                        <option></option>

                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account Type</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_LedgerType">
                        <option></option>
                        <option>GL</option>
                        <option>INCOME</option>
                        <option>EXPENDITURE</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Ledger Category</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_LedgerCtgry">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Ledger Account Name</label>
                      <input type="text" class="form-control form-control-user ep" id="txt-newLedgerName">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">BILLING TYPE</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_LedgerBill">
                        <option></option>
                        <option id="BL">BILLING</option>
                        <option id="NB">NON-BILLING</option>
                      </select>
                    </div>
                  </div>
                  <form class="user">
                    <a href="#" class="btn btn-success btn-user btn-block" id="btn-new-ledger-account">
                      Add New Ledger Account
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-8 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Existing Ledger Account</h6>
                </div>
                <div class="card-body" id="display_new_ledger_account">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of  Ledger Account Content -->

        <!-- Begin New Consignment Page Content -->
        <div class="container-fluid sub-basic-setup" id="new-consignment-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">New Consignment</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Cargo Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
                      <label for="exampleFormControlInput1">Consignment ID</label>
                      <label class="form-control form-control-user label-form-control-user" id="newConsignmentID"></label>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">D.O.T.*</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="dot_new_conisgnment">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">ETA*</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="eta_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Shipping Line* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newCarrierModals" id="addCarrierModals"></i></label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_shipper_new_conisgnment">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Shipper* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newShipperModal" id="addShipperModal"></i></label>
                      <label type="text" class="form-control" hidden='' id='shpperid_new_consignment'></label>
                      <input type="text" class="form-control form-control-user ep" id="shipper_new_conisgnment">
                      <div id='display_shipper_search_info' class='div_search_box'></div>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Vessel Name*</label>
                      <input type="text" class="form-control form-control-user ep" id="vessel_new_conisgnment">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Voyage No.*</label>
                      <input type="text" class="form-control form-control-user ep" id="voyageNo_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Bill Of Laden*</label>
                      <input type="text" class="form-control form-control-user ep" id="bl_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Place of Issue*</label>
                      <input type="text" class="form-control form-control-user ep" id="pois_new_conisgnment">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Date of Issue*</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="dois_new_conisgnment">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Shipped on Board*</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="sob_new_conisgnment">
                    </div>
                  </div>
                  <div class="form-group row">


                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">P.O.L.* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newPOLModal" id="addPOLModal"></i></label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_pol_new_conisgnment">
                        <option></option>

                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">P.O.D.* <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newPODModal" id="addPODModal"></i></label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_pod_new_conisgnment">
                        <option></option>

                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Rotation #*</label>
                      <input type="text" class="form-control form-control-user ep" id="rotation_new_conisgnment">
                    </div>

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Agent's Contact*</label>
                      <input type="text" class="form-control form-control-user ep" id="agent_contact_new_conisgnment">
                    </div>
                  </div>
                  <div class="form-group row">


                  </div>
                  <div class="card-header py-3 mb-3">
                    <h6 class="m-0 mb-2 font-weight-bold text-success">Container Details</h6>
                  </div>
                  <div class="form-group row">

                    <div class="col-sm-3 mb-3">
                      <label for="exampleFormControlInput1">Seal No.*</label>
                      <input type="text" class="form-control form-control-user ef" id="sealNo_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="exampleFormControlInput1">Container No.*</label>
                      <input type="text" class="form-control form-control-user ef" id="cntNo_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="exampleFormControlInput1">Container Size*</label>
                      <input type="text" class="form-control form-control-user ef" id="cntSize_new_conisgnment">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="exampleFormControlInput1">Gross Weight (KG)*</label>
                      <input type="number" class="form-control form-control-user ef" id="weight_new_conisgnment">
                    </div>
                    <div class="col-sm-4 mb-3">
                      <label for="exampleFormControlInput1">Est. Handling Cost*</label>
                      <input type="number" class="form-control form-control-user ef" id="tcost_handling_new_conisgnment">
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="new_consignment_rcptid"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="new_consignment_rcptno"></label>
                    </div>
                    <form class="col-sm-4 mb-3 user">
                      <label for="exampleFormControlInput1"></label>
                      <a class="btn btn-warning btn-user btn-block" id="btn_new_container_details">
                        Add New Container
                      </a>
                    </form>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" style="border:1px solid #bbb;">
                      <div class="card-body" id="display_new_container_details">

                      </div>
                    </div>
                  </div>
                  <form class="user">
                    <a class="btn btn-success btn-user btn-block" id="btn_new_consignment">
                      Add New Consignment
                    </a>
                  </form>
                </div>
              </div>

            </div>

            <div class="col-lg-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pending Consigment</h6>
                </div>
                <div class="card-body" id="display_new_consignment">

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of New consignmentContent -->

        <!-- Begin Cargo manifestation Content -->
        <div class="container-fluid sub-basic-setup" id="new-cargo-manifestation-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cargo Manifest</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">House BL Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
                      <label for="exampleFormControlInput1">Consignment ID</label>
                      <label class="form-control form-control-user label-form-control-user" id="newConsignmentID"></label>
                    </div>
                    <div class="col-sm-5 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Main BL </label>
                      <label type="text" class="form-control" hidden='' id='seach_mainBL_new_consignee'></label>
                      <input type="text" class="form-control form-control-user ep" id="mainBL_search_conisgnee" placeholder="Enter Main BL">
                      <div id='display_mainBL_search_info' class='div_search_box'></div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_main_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Manifest Breakdown </h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">House BL#</label>
                      <input class="form-control form-control-user ep" id="houseBL_consignee_breakown" />
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Consignee <i class="fas fa-plus text-danger" data-toggle="modal" data-target="#newConsigneeModal" id="addConsigneeModal"></i></label>
                      <label type="text" class="form-control ep" hidden='' id='hbl_consignee_id'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_hbl_consignee_fname" autocomplete="off" placeholder="Full Name of Consignee">
                      <div id='display_hBL_search_consignee_info' class='div_search_box'></div>
                    </div>

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Notify Party</label>
                      <label type="text" class="form-control ep" hidden='' id='hbl_consignee2_id'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_hbl_consignee2_fname" placeholder="Notify Party">
                      <div id='display_hBL_search_consignee2_info' class='div_search_box'></div>
                    </div>

                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Weight</label>
                      <input type="number" class="form-control form-control-user ep" id="hBL_conisgnee_weight">
                    </div>

                    <div class="col-sm-1 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Package</label>
                      <input type="number" class="form-control form-control-user ep" id="hBL_conisgnee_pkg">
                    </div>

                    <div class="col-sm-1 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Unit</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_hBL_conisgnee_unit">
                        <option></option>
                        <option>LOT</option>
                        <option>PLT</option>
                        <option>PKG</option>
                        <option>UNIT</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Item Type*</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="sel_hBL_conisgnee_item_type">
                        <option></option>
                        <option>GOODS</option>
                        <option>VEHICLE</option>
                        <option>MOTORBIKE</option>
                      </select>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description*</label>
                      <textarea type="text" class="form-control form-control-user ep" id="hBL_conisgnee_description"></textarea>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">VIN **</label>
                      <textarea type="text" class="form-control form-control-user ep" id="hBL_conisgnee_vin"></textarea>
                    </div>

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Other Info **</label>
                      <textarea type="text" class="form-control form-control-user ep" id="hBL_conisgnee_other_info"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_consignee_manifestation">
                        Add Consignee Breakdown
                      </a>
                    </form>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /. End of Cargo manifestation Content -->

        <!-- Begin HBL Inovice Content -->
        <div class="container-fluid sub-basic-setup" id="new-house-bl-invoice-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">House BL Invoicing</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Consignee Manifest Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Consignee Name or House BL#</label> <i class="fas fa-eye text-warning float-right" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
                      <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='seach_hbl_invoicing_consignee'></label>
                      <input type="text" class="form-control form-control-user ep" id="invoicing_hbl_search_conisgnee" autocomplete="off" placeholder="Enter Consignee Name/ House BL#">
                      <div id='display_hBL_invoicing_search_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Consignee Manifest Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_hbl_invoice_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Additional Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_hBL_acc_invoice">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="hBL_amt_invoice">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_rcpt_id_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_hblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_mblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="hBL_rcpt_no_invoice"></label>
                    </div>
                  </div>
                  <div class="custom-control custom-switch mb-2">
                    <input type="checkbox" data-toggle="toggle" checked class="custom-control-input checkStatus" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Taxable</label>
                  </div>
                  <div class="form-group row">
                    <form class="user">
                      <button class="btn btn-success btn-user btn-block" id="btn_add_charge_consignee_invoice">
                        Add/Update Charge
                      </button>
                    </form>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Handling Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_hbl_invoice_charges_display">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of HBL Invoice Content -->

        <!-- Begin HBL Inovice Content -->
        <div class="container-fluid sub-basic-setup" id="new-customer-waybill-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer Waybill</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-7 mb-7">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">House BL Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Existing Waybill</label> <i class="fas fa-eye text-warning float-right" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
                      <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='seach_hbl_invoicing_consignee'></label>
                      <input type="text" class="form-control form-control-user ep" id="txt_housebl_customer_waybill" autocomplete="off" placeholder="Enter Consignee or Vehicle # ">
                      <div id='display_hBL_waybill_search_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Existing Waybill</h6>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="consignee_existing_waybill_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-7">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"> Waybill Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Consignee Name</label>
                      <input type="text" class="form-control form-control-user ep" id="waybill_consignee_name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Vehicle No.</label>
                      <input type="text" class="form-control form-control-user ep" id="waybill_vehicle_no">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Driver's Name</label>
                      <input type="text" class="form-control form-control-user ep" id="waybill_driver_name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Port</label>
                      <input type="text" class="form-control form-control-user ep" id="waybill_port">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Driver's License No.</label>
                      <input type="text" class="form-control form-control-user ep" id="waybill_driver_license">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Package</label>
                      <input class="form-control form-control-user ep" id="waybill_package" />
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input class="form-control form-control-user ep" id="waybill_description" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Quantity</label>
                      <input class="form-control form-control-user ep" id="waybill_qty" />
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Date</label>
                      <input class="form-control form-control-user ep datepicker" id="waybill_date" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_add_new_waybill">
                        Add New Waybill
                      </a>
                    </form>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
        <!-- /. End of HBL Invoice Content -->

        <!-- Begin Cargo manifestation Content -->
        <div class="container-fluid sub-basic-setup" id="new-other-serv-invoice-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Other Service Invoice</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Client Name</label> <i class="fas fa-plus text-danger float-right ml-3 addNewConsignee" data-toggle="modal" data-target="#newConsigneeModal" id="addCleintModal"></i><i class="fas fa-eye text-warning float-right sr-only" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
                      <label type="text" class="form-control ep sr-only" id='search_client_oth_serv_id'></label>
                      <input type="text" class="form-control form-control-user ep client-det-search" id='search_client_other_invoice' autocomplete="off" placeholder="">
                      <div id='display_hBL_invoicing_search_info' class='div_search_box client-search-show'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Recent Client's Activity</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_hbl_invoice_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Additional Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">D.O.T</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="client_dot_invoice" autocomplete="off" placeholder="">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="client_rcpt_id_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="client_rcpt_no_invoice"></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_ots_acc_invoice">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep epp" id="client_amt_invoice">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep epp" id="client_desc_invoice">
                    </div>
                  </div>

                  <div class="form-group row">

                    <button class="btn btn-success btn-user btn-block p-2" style="border-radius: 50px;" id="btn_add_charge_client_invoice">
                      Add/Update Charge
                    </button>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="">

                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Handling Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="client_charges_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Cargo manifestation Content -->

        <!-- Begin Cargo manifestation Content -->
        <div class="container-fluid sub-basic-setup" id="new-non-manifest-invoice-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Non-Manifest Invoice</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Client Name/ BL#</label> <i class="fas fa-plus text-danger float-right ml-3 addNewConsignee" data-toggle="modal" data-target="#newConsigneeModal" id="addCleintModal"></i><i class="fas fa-eye text-warning float-right sr-only" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
                      <label type="text" class="form-control label-form-control-user sr-only ep new_consignee_id" id='consignee_id_invoice_nonm'></label>
                      <input type="text" class="form-control form-control-user ep new_consignee_name" id="search_consignee_manifest" autocomplete="off" placeholder="">
                      <div id='display_hBL_invoicing_search_info' class='div_search_box client-search-show'></div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">BL#</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_bl_invoice_nonm">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Item</label>
                      <input type="text" class="form-control form-control-user ep" id="client_desc_invoice_nonm" autocomplete="off" placeholder="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">D.O.T</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="client_dot_invoice_nonm" autocomplete="off" placeholder="">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="client_rcpt_id_invoice_nonm"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="client_rcpt_no_invoice_nonm"></label>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2 sr-only">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Recent Client's Activity</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_hbl_invoice_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Charges Added</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="client_charges_display_details_nonm">

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_ots_acc_invoice_nonm">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep epp" id="client_amt_invoice_nonm">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" data-toggle="toggle" checked class="custom-control-input checkStatus" id="customSwitch2">
                      <label class="custom-control-label" for="customSwitch2">Taxables</label>
                    </div>
                  </div>

                  <div class="form-group row">

                    <button class="btn btn-success btn-user btn-block p-2" style="border-radius: 50px;" id="btn_add_charge_client_invoice_nonm">
                      Add/Update Charge
                    </button>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="">

                    </div>
                  </div>
                </div>
              </div>

            </div>


          </div>

        </div>
        <!-- /. End of Cargo manifestation Content -->


        <!-- Begin Receive Invoice Charges Content -->
        <div class="container-fluid sub-basic-setup" id="rcv-invoice-charge-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Receive Invoice Charges</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Invoice Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Client Invoice</label>
                      <label type="text" class="form-control ep" hidden='' id='consignee_id_invoice_pmt'></label>
                      <input type="text" class="form-control form-control-user ep" id="consignee_invoice_payment">
                      <div id='display_consginee_invoice_pmt_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Invoice Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_invoice_pmt_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="invoice_pmt_amt">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Cash Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="invoice_pmt_sel_cash_acc">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Payment Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="invoice_pmt_dot">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="invoice_pmt_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="invoice_pmt_hblid"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="invoice_pmt_mblid"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="invoice_pmt_rcpt_no"></label>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep" id="invoice_pmt_description">
                    </div>
                  </div>
                  <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_consignee_invoice_payment">
                        Save Invoice Payment
                      </a>
                    </form>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Receive Invoice Charges Content -->

        <!-- Begin Receive Declaration Charges Content -->
        <div class="container-fluid sub-basic-setup" id="rcv-process-declaration-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Process Declaration</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Declaration Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Enter BL #</label>
                      <input type="text" class="form-control form-control-user ep" placeholder="Search BL No." id="dclr_prcs_bl_search">
                      <div id='display_dclr_prcs_bl_search' class='div_search_box'></div>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Declaration No.</label>
                      <input type="text" class="form-control form-control-user ep" placeholder="" id="dclr_prcs_decl_no">
                    </div>
                    <div class="col-sm-6 mb-6 mb-sm-0">
                      <label for="exampleFormControlInput1">Item Description</label>
                      <input class="form-control form-control-user ep" id="dclr_prcs_desc" placeholder="Item Description" required />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Duty Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="dclr_prcs_duty_amt" placeholder="" required />
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Agent's Name</label>
                      <input type="text" class="form-control form-control-user ep" id="dclr_prcs_agent_name">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Agent's Contact</label>
                      <input type="text" class="form-control form-control-user ep" id="dclr_prcs_agent_telno">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Container Size</label>
                      <input type="text" class="form-control form-control-user ep" id="dclr_prcs_cnt_size">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount Charge</label>
                      <input type="number" class="form-control form-control-user ep" id="dclr_prcs_amt_charge" placeholder="" required />
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Payment Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="dclr_prcs_pmt_dt">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="dclr_prcs_sel_cash_acc">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="dclr_prcs_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="dclr_prcs_rcpt_no"></label>
                    </div>
                  </div>
                  <div class="col-sm-12 mb-12 mb-sm-0">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_process_declaration">
                        Save Declaration
                      </a>
                    </form>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Receive Invoice Charges Content -->

        <!-- Begin Receive Invoice Charges Content -->
        <div class="container-fluid sub-basic-setup" id="pay-invoice-charge-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Handling Charge Expenditure</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Main BL Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search Main BL#</label>
                      <label type="text" class="form-control ep" hidden='' id='consignee_id_pmt_expense'></label>
                      <input type="text" class="form-control form-control-user ep" id="consignee_invoice_rcv">
                      <div id='display_consginee_invoice_rcv_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Invoice Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_exp_pmt_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="invoice_pmt_exp_amt">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Source Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="invoice_pmt_exp_sel_cash_acc">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Cash Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="invoice_pmt_exp_cash_bal"></label>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Expenditure Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="invoice_pmt_exp_sel_cash_acc1">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Cash Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="invoice_pmt_exp_cash_bal"></label>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Payment Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="invoice_pmt_exp_dot">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="invoice_pmt_exp_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="invoice_pmt_exp_mblid"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="invoice_pmt_exp_rcpt_no"></label>
                    </div>
                    <div class="col-sm-9 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep" id="invoice_pmt_exp_description">
                    </div>
                  </div>
                  <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_consignee_invoice_payment_exp">
                        Save Handling Charge Expenditure
                      </a>
                    </form>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Receive Invoice Charges Content -->

        <!-- Begin Receive Invoice Charges Content -->
        <?php include_once 'modules/panel/_service_charge_income_panel.php'; ?>
        <!-- /. End of Receive Invoice Charges Content -->

        <?php if (mysqli_num_rows($exp_q) == 1) { ?>
          <!-- Begin Petty Cash Expenditure Transaction Content -->
          <div class="container-fluid sub-basic-setup" id="expenditure-transaction-panel">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Expenditure Transaction</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Content Column -->

              <div class="col-sm-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4" id="manifestation_breakdown_card">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                  </div>
                  <div class="card-body">

                    <div class="form-group row">

                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Petty Cash Balance</label>
                        <label class="form-control form-control-user label-form-control-user ep" id="txt_pmt_exp_cash_bal"></label>
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Expenditure Account</label>
                        <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_expense_transaction_account">
                          <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Amount</label>
                        <input type="number" class="form-control form-control-user ep" id="txt_pmt_exp_amt">
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Transaction Date</label>
                        <input type="text" class="form-control form-control-user datepicker ep" id="txt_pmt_exp_dot">
                      </div>
                    </div>
                    <div class="form-group row">

                      <div class="col-sm-2 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Transaction ID</label>
                        <label class="form-control form-control-user label-form-control-user ep sr-only" id="lbl_pmt_exp_rcpt_id"></label>
                        <label class="form-control form-control-user label-form-control-user ep sr-only" id="lbl_pmt_exp_mblid"></label>
                        <label class="form-control form-control-user label-form-control-user ep" id="lbl_pmt_exp_rcpt_no"></label>
                      </div>
                      <div class="col-sm-7 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1">Description</label>
                        <input type="text" class="form-control form-control-user ep" id="txt_pmt_exp_description">
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <label for="exampleFormControlInput1"></label>
                        <form class="user">
                          <a class="btn btn-success btn-user btn-block" id="btn_save_expense_petty_cash">
                            Save Expenditure
                          </a>
                        </form>
                      </div>
                    </div>
                    <div class="form-group row">

                    </div>
                  </div>
                </div>

              </div>

            </div>

          </div>
          <!-- /. End of Petty Cash Expenditure Transaction Content -->
        <?php } ?>
        <!-- Begin GL Transfers Content -->


        <div class="container-fluid sub-basic-setup" id="gl-transaction-panel">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">General Ledger Transfer</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Debit Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg gl_account ep" id="sel_glDr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Debit Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_rglDr_cash_bal"></label>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Credit Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg gl_account ep" id="sel_glCr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Credit Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_rglCr_cash_bal"></label>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="txt_glDrCr_amt">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="txt_glDrCr_dot">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="lbl_glDrCr_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="lbl_glDrCr_rcpt_no"></label>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep" id="txt_glDrCr_description">
                    </div>
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1"></label>
                      <form class="user">
                        <a class="btn btn-success btn-user btn-block" id="btn_save_glDrCr">
                          Save Transaction
                        </a>
                      </form>
                    </div>
                  </div>
                  <div class="form-group row">

                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of GL Transfers Content -->


        <!-- Begin HBL Inovice Content -->
        <div class="container-fluid sub-basic-setup" id="disbursement-analysis-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Disbursement Analysis - FCL</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disbursement Search Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search By Main BL</label> <i class="fas fa-broom text-danger float-right" title="Clear disbursment analysis" id="clearDisbursementAnalysis"></i> <i class="fas fa-eye text-primary float-right" title="View disbursment analysis" id="viewDisbursementAnalysis"></i>
                      <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='seach_hbl_invoicing_consignee'></label>
                      <input type="text" class="form-control form-control-user ep" id="txt_disbursement_bl_search" autocomplete="off" placeholder="Enter BL #">
                      <div id='disbursement_search_info' class='div_search_box'></div>
                      <div id="recent_disbursement_bl"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Main BL Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="disbursement_fcl_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Summary</h6>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Total Income</label>
                      <input type="number" class="form-control form-control-user" autocomplete="off" placeholder="Enter Income Received" id="txtTotalDisbursementIncome">

                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Balance Outstanding</label>
                      <label class="form-control form-control-user label-form-control-user" id="lblTotalDisbursement"></label>
                    </div>
                  </div>
                  <div class="form-group row mt-3">

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Receipt No.</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_rcpt_id_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_hblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_mblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="hBL_rcpt_no_invoice"></label>
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Date of Transaction</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="txt_disbursement_DOT">
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">
                      <form class="user">
                        <a class="btn btn-success btn-user btn-block" id="btn_save_disbursement">
                          Save Disbursement
                        </a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disbursement Account Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="disbursement_fcl_account_display">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of HBL Invoice Content -->


        <!-- Begin Dr GL Cr Icome Content -->
        <div class="container-fluid sub-basic-setup" id="drGlCrIncome-transaction-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Debit G.L. A/C - Credit Income Transaction</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Debit Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg gl_account ep" id="sel_dr_glDrIncCr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Debit Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_dr_glDrIncCr_cash_bal"></label>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Credit Income Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ie_account ep" id="sel_cr_glDrIncCr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Income Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_cr_glDrIncCr_cash_bal"></label>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="txt_glDrIncCr_amt">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="txt_glDrIncCr_dot">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="lbl_glDrIncCr_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="lbl_glDrIncCr_rcpt_no"></label>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep" id="txt_glDrIncCr_description">
                    </div>
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1"></label>
                      <form class="user">
                        <a class="btn btn-success btn-user btn-block" id="btn_save_glDrIncCr">
                          Save Transaction
                        </a>
                      </form>
                    </div>
                  </div>
                  <div class="form-group row">

                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Dr GL Cr Icome  Content -->


        <!-- Begin Dr GL Cr Icome Content -->
        <div class="container-fluid sub-basic-setup" id="crGlDrExpense-transaction-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Credit G.L. A/C - Debit Expense A/C</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->

            <div class="col-sm-12 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">

                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Credit GL Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg gl_account ep" id="sel_cr_expDrGLCr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Credit Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_cr_expDrGLCr_cash_bal"></label>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Debit Expense Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ie_account ep" id="sel_dr_expDrGLCr_account">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Expense Account Balance</label>
                      <label class="form-control form-control-user label-form-control-user ep" id="txt_dr_expDrGLCr_cash_bal"></label>
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep" id="txt_expDrGLCr_amt">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction Date</label>
                      <input type="text" class="form-control form-control-user datepicker ep" id="txt_expDrGLCr_dot">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="lbl_expDrGLCr_rcpt_id"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="lbl_expDrGLCr_rcpt_no"></label>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep" id="txt_expDrGLCr_description">
                    </div>
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1"></label>
                      <form class="user">
                        <a class="btn btn-success btn-user btn-block" id="btn_save_expDrGLCr">
                          Save Transaction
                        </a>
                      </form>
                    </div>
                  </div>
                  <div class="form-group row">

                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Dr GL Cr Icome  Content -->

        <!-- Begin Cargo manifestation Content -->
        <div class="container-fluid sub-basic-setup" id="new-client-trans-details">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Client Transaction Details</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Client Profile</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Client Name or TIN#</label>
                      <label type="text" class="form-control ep" hidden='' id='client_id_profile_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_client_profile_rpt" placeholder="Enter Consignee Name/ House BL#">
                      <div id='display_client_profile_search_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
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
                  <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" style="overflow-y: scroll; max-height: 300px;" id="cosignee_profile_recent_activity">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Cargo manifestation Content -->

        <!-- Begin Transaction Report Content -->
        <div class="container-fluid sub-basic-setup" id="new-accounting-report">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction Report</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <?php include_once 'modules/report/_income_report.php'; ?>

            <?php include_once 'modules/report/_expense_report.php'; ?>

            <?php include_once 'modules/report/_general_ledger_report.php'; ?>

            <?php include_once 'modules/report/_financial_statement.php'; ?>

            <?php include_once 'modules/report/_income_statement.php'; ?>
          </div>

        </div>
        <!-- /. End of Transaction Report Content -->

        <!-- Begin View Other Report Content -->
        <div class="container-fluid sub-basic-setup" id="view-other-report">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Other Report Panel</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-1">
              <div class="row">
                <!-- Project Card Example -->
                <div class="col-sm-12 mb-2">
                  <div class="card shadow mb-2">
                    <div class="card-header py-2 bg-success">
                      <h6 class="m-0 font-weight-bold text-white">Declaration Income View</h6>
                    </div>
                    <div class="card-body">
                      <div class="form-group row">
                        <div class="col-sm-4 mb-1 mb-sm-0">
                          <input type="text" class="form-control form-control-user ep datepicker" id="sel_decl_inc_fdate" placeholder="Select First Date">
                        </div>
                        <div class="col-sm-5 mb-1 mb-sm-0">
                          <input type="text" class="form-control form-control-user ep datepicker" id="sel_decl_inc_ldate" placeholder="Select Last Date">
                        </div>
                        <div class="col-sm-2 mb-1 mb-sm-0">
                          <button type="button" class="btn btn-success" id="btn_search_processed_declaration">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 mb-2">
                  <!-- Project Card Example -->
                  <div class="card shadow mb-2">
                    <div class="card-header py-2 bg-danger">
                      <h6 class="m-0 font-weight-bold text-white">Handling Cost Income View</h6>
                    </div>
                    <div class="card-body">

                      <div class="form-group row">
                        <div class="col-sm-12 mb-1 mb-sm-0">
                          <label for="exampleFormControlInput1">House BL#</label>
                          <label type="text" class="form-control ep" hidden='' id='hbl_id_profile_view_search'></label>
                          <input type="text" class="form-control form-control-user ep" id="search_housebl_profile_handling_cost_view" placeholder="Enter House BL# or Client Name">
                          <div id='display_hbl_handling_cost_view_search_info' class='div_search_box'></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 mb-2">
                  <!-- Project Card Example -->
                  <div class="card shadow mb-2">
                    <div class="card-header py-2 bg-danger">
                      <h6 class="m-0 font-weight-bold text-white">Client Bill View</h6>
                    </div>
                    <div class="card-body">

                      <div class="form-group row">
                        <div class="col-sm-12 mb-1 mb-sm-0">
                          <label for="exampleFormControlInput1">Search Client Name</label>
                          <label type="text" class="form-control ep sr-only" id='client_id_nom_bill_search'></label>
                          <input type="text" class="form-control form-control-user ep" id="client_nonm_bill_view" placeholder="Enter Client Name">
                          <div id='display_nonm_bill_client_Search' class='div_search_box'></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="other_report_view_card">
                <div class="card-header py-2">
                  <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0" id="view_other_report_search_result">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of View Other Report Content -->


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
                      <input type="text" class="form-control form-control-user ep" id="search_consignment_profile_rpt" placeholder="Enter Bill of Laden/ Carrier/ Vessel Name">
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

        <!-- Begin Edit Consignment Details Content -->
        <div class="container-fluid sub-basic-setup" id="edit-consignment-details">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Consigment Details</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-6 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success">
                  <h6 class="m-0 font-weight-bold text-white">Consignment Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Bill of Lading #</label>
                      <label type="text" class="form-control ep" hidden='' id='cns_id_profile_edit_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_consignment_profile_edit" placeholder="Enter Main BL">
                      <div id='display_cns_profile_edit_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                  <h6 class="m-0 font-weight-bold text-white">House BL Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">House BL#</label>
                      <label type="text" class="form-control ep" hidden='' id='hbl_id_profile_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_housebl_profile_rpt" placeholder="Enter House BL# or Client Name">
                      <div id='display_hbl_profile_search_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0" id="cons_profile_edit_search_result">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Edit Consignment Detail Content -->

        <!-- Begin Edit Consignment Weights Content -->
        <div class="container-fluid sub-basic-setup" id="edit-consignment-weight">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Consignment Weight</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-12 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success">
                  <h6 class="m-0 font-weight-bold text-white">Consignment Search</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Bill of Lading #</label>
                      <label type="text" class="form-control ep" hidden='' id='cns_id_wieght_edit_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_consignment_weight_edit" placeholder="Enter Main BL">
                      <div id='display_cns_weight_edit_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0" id="cons_wieght_edit_search_result">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Edit Consignment Weight Content -->

        <!-- Begin Reverse Transaction Content -->
        <div class="container-fluid sub-basic-setup" id="reverse-transaction-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Reverse Consignment Register/ Cargo Manifest/ User Transaction </h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-4 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-2 bg-danger">
                  <h6 class="m-0 font-weight-bold text-white">Reverse Consignment Register</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction No.</label>
                      <label type="text" class="form-control ep" hidden='' id='cns_id_reverse_transaction_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_reverse_transaction_edit" placeholder="Enter Main BL">
                      <div id='display_reverse_transaction_edit_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Column -->
            <div class="col-sm-4 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-2 bg-danger">
                  <h6 class="m-0 font-weight-bold text-white">Reverse Cargo Manifest</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction No.</label>
                      <label type="text" class="form-control ep" hidden='' id='cns_id_wieght_edit_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_consignment_weight_edit" placeholder="Enter Main BL">
                      <div id='display_cns_weight_edit_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Column -->
            <div class="col-sm-4 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-2 bg-danger">
                  <h6 class="m-0 font-weight-bold text-white">Reverse User Transaction</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction No.</label>
                      <label type="text" class="form-control ep" hidden='' id='cns_id_wieght_edit_search'></label>
                      <input type="text" class="form-control form-control-user ep" id="search_consignment_weight_edit" placeholder="Enter Main BL">
                      <div id='display_cns_weight_edit_info' class='div_search_box'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0" id="cons_wieght_edit_search_result">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Edit Consignment Weight Content -->

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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- New P.O.L. Modal-->
  <div class="modal fade" id="newPOLModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New P.O.L.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
              <label for="exampleFormControlInput1">P.O.L. ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newPOLID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">P.O.L.</label>
              <input type="text" class="form-control form-control-user ep" id="newpolName">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_pol">Add</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pol_list">
              <!-- Approach -->
              This is where the details approached
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- New Shipping Line Modal-->
  <div class="modal fade" id="newCarrierModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Shipping Line</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
              <label for="exampleFormControlInput1">Shipping line ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newCarrierID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Shipping Line</label>
              <input type="text" class="form-control form-control-user ep" id="newCarrierName">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_carrier">Add</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_carrier_list">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- New P.O.L. Modal-->
  <div class="modal fade" id="newPODModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New P.O.D.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
              <label for="exampleFormControlInput1">P.O.D. ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newPODID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">P.O.D.</label>
              <input type="text" class="form-control form-control-user ep" id="newpodName">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_pod">Add</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pod_list">
              <!-- Approach -->
              This is where the details approached
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- New Shipper Modal-->
  <div class="modal fade" id="newShipperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Shipper's Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0b sr-only">
              <label for="exampleFormControlInput1">Shipper ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newshpID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Shipper's Name *</label>
              <input type="text" class="form-control form-control-user ep" id="newshpName">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 1 *</label>
              <textarea class="form-control form-control-user ep" id="newshpAdd1" placeholder="Shipper's Address" required></textarea>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 2 *</label>
              <textarea class="form-control form-control-user ep" id="newshpAdd2" placeholder="Shipper's Address" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">City - Country</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd3">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Telephone No.</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd4">
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_shipper">Add New Shipper</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pod_list">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- New Consignee/Notify Party Modal-->
  <div class="modal animated--grow-in" id="newConsigneeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Consignee/ Notify Party</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0b">
              <label for="exampleFormControlInput1">Consignee ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newcnsID"></label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Full Name *</label>
              <input type="text" class="form-control form-control-user ep" id="newcnsName">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 1 *</label>
              <textarea class="form-control form-control-user ep" id="newcnsAdd1" placeholder="Shipper's Address" required></textarea>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Address Line 2 *</label>
              <textarea class="form-control form-control-user ep" id="newcnsAdd2" placeholder="Shipper's Address" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">TIN Number</label>
              <input type="text" class="form-control form-control-user ep" id="newshpAdd3">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Telehone No. *</label>
              <input type="text" class="form-control form-control-user ep" id="newcnsTel">
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
              <button class="btn btn-success" type="button" id="btn_add_new_consignee">Add New Consignee</button>
            </div>
            <hr class="sidebar-divider my-0">
          </div>
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_consignee_list">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Consignee Manifestation breakdown-->
  <div class="modal animated--grow-in" id="editManifestBreakdownTemp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Manifest Breakdown</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="editTempBreakdown_body">

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- New Consignee-In Process Modal-->
  <div class="modal animated--grow-in" id="consigneeInProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Consignee In Process</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_consignee_in_process">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Client Option View/ Invoice-->
  <div class="modal animated--grow-in" id="clientProfileInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-group row">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <div class="col-lg-12 mb-4" id="display_client_proifle_invoice_view">
              <!-- Approach -->
            </div>
          </div>
        </div>
        <div class="modal-footer sr-only">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!--Processed Declaration Income  -->
  <div class="modal animated--grow-in" id="viewDelcarationProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">VIEW PROCESSED DECLARATION DETAILS</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="display_ProcessDeclaration">

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Consignment Detail View Modal-->
  <div class="modal fade" id="ConsDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">Details of Consignment Profile</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_consignment_detail_profile_list">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer sr-only">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Consignment Pending Modal-->
  <div class="modal fade" id="editConsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Edit Consignment Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-lg-12 mb-4" id="display_pending_cons_edit">
              <!-- Approach -->

            </div>
          </div>
        </div>
        <div class="modal-footer sr-only">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- This is the footer bar -->
  <?php include 'script_bottom.php'; ?>

</body>

</html>