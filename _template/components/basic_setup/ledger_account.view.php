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