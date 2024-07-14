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