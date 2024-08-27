  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin-model">
      <div class="sidebar-brand-icon">
        <i class="fas fa-gem"></i>
      </div>
      <div class="sidebar-brand-text mx-1"><?= COMPANY_INIT; ?></div>
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
    <div class="sidebar-heading <?= !$userAuth['BasicConfig'] ? "sr-only" : "" ?> ">
      SETUP & CONFIG
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= !$userAuth['BasicConfig'] ? "sr-only" : "" ?> ">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Basic Setup</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner">
          <h6 class="collapse-header sr-only">Custom Components:</h6>
          <a class="collapse-item" id="ledger_control_panel">Ledger Control</a>
          <a class="collapse-item" id="ledger_control_category_panel">Ledger Category</a>
          <a class="collapse-item" id="ledger_control_account_panel">Ledger Account</a>
          <a class="collapse-item" id="handling_charges_setup_tab">Handling Charges Setup</a>
          <a class="collapse-item" id="disbursement_charges_setup_tab">Disbursement Setup</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      consignment utilities
    </div>
    <!-- Nav Item - Consignment Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsignment" aria-expanded="true" aria-controls="collapseConsignment">
        <i class="fas fa-fw fa-dolly"></i>
        <span>Consignment Register</span>
      </a>
      <div id="collapseConsignment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner rounded">
          <h6 class="collapse-header sr-only">Consignment Utilities:</h6>
          <a class="collapse-item" id="new-consignment-tab">New Consignment</a>
          <a class="collapse-item <?= !$userAuth['AssignConsignmentOfficer'] ? "sr-only" : "" ?>" id="new-cargo-manifestation-tab">Assign Officer</a>

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
        <div class="bg-dark py-2 collapse-inner rounded">
          <a class="collapse-item" id="new-house-bl-invoice-tab">BL Invoice</a>
          <a class="collapse-item" id="new-customer-waybill">Customer Waybill</a>
          <a class="collapse-item" id="new-other-serv-invoice-tab">Other Serv. Invoice</a>
          <a class="collapse-item" id="new-non-manifest-invoice-tab">Non-BL Invoice</a>
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
        <div class="bg-dark py-2 collapse-inner rounded">
          <a class="collapse-item" id="rcv-process-decalartion-tab">Process Declaration</a>
          <a class="collapse-item" id="rcv-invoice-charge-tab">Receive Handl. Charge</a>
          <a class="collapse-item" id="rcv-service-charge-tab">Receive Service Charge</a>
          <!-- <a class="collapse-item" id="rcv-customer-charge-tab">Client Payment</a> -->
          <a class="collapse-item" id="pay-invoice-charge-tab">Handl. Charge Expense</a>

          <?php if ($userAuth['PettyCash']) { ?>

            <a class="collapse-item" id="expense-transaction-tab">Expenditure Transaction</a>;

          <?php } ?>

          <div class="collapse-divider"></div>
        </div>
      </div>
    </li>

    <li class="nav-item <?= !$userAuth['GLTransaction'] ? "sr-only" : "" ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#LedgerTransactions" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Ledger Transaction</span>
      </a>
      <div id="LedgerTransactions" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner rounded">
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

    <li class="nav-item <?= !$userAuth['Disbursement'] ? "sr-only" : "" ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#disbursement-panel" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-layer-group"></i>
        <span>Disbursement Analysis</span>
      </a>
      <div id="disbursement-panel" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner rounded">

          <?php if ($userAuth['DisbursementAnalysis']) { ?>
            <a class="collapse-item" id="new-disbursement-fcl-tab">Disbursement</a>
          <?php } ?>

          <?php if ($userAuth['DisbursementApproval']) { ?>
            <a class="collapse-item disbursement_analysis" id="new-disbursement-approval-review-tab" data-toggle="modal" data-target="#disbursementAnalysisNA">Approval Review</a>
          <?php } ?>
          <div class="collapse-divider"></div>
        </div>
      </div>
    </li>

    <?php if ($userAuth['Transport']) { ?>
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Transport Tracker
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#TransTrackTab" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-truck-moving"></i>
          <span>Vehicle Hub</span>
        </a>
        <div id="TransTrackTab" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-dark py-2 collapse-inner rounded">
            <a class="collapse-item" id="truck-new-vehicle">Register New Vehicle</a>
            <a class="collapse-item" id="truck-new-driver">Register New Driver</a>
            <a class="collapse-item" id="schedule-trip">Schedule Cargo Trip</a>
            <a class="collapse-item" id="truck-inspection">Vehicle Inspection</a>
            <a class="collapse-item" id="reverse-transaction">Vehicle Expense</a>
            <a class="collapse-item" id="reverse-transaction">Vehicle Incident</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>
    <?php } ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
      Edit Panel
    </div>
    <!-- Edit Data -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" data-target="#EditDataTab" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-user-edit"></i>
        <span>Edit Data</span>
      </a>
      <div id="EditDataTab" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner rounded">
          <a class="collapse-item" id="edit-consigment-details">Edit Consignment</a>
          <a class="collapse-item" id="edit-consigment-weight">Edit Weight</a>

          <?php if ($userAuth['ReverseTransaction']) { ?>

            <a class="collapse-item" id="reverse-transaction">Reverse Transaction</a>

          <?php } ?>

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
        <div class="bg-dark py-2 collapse-inner rounded">
          <a class="collapse-item" id="rpt-consigment-details">Consignment Details</a>
          <a class="collapse-item" id="rpt-client-trans-details">Client Trans. Details</a>
          <a class="collapse-item" id="rpt-accounting-report">Transaction Report</a>
          <a class="collapse-item" id="rpt-disbursement-report">Disbursement Report</a>
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