<!-- Begin HBL Inovice Content -->
<div class="container-fluid sub-basic-setup" id="new-house-bl-invoice-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">BL Invoicing</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-sm-5 mb-2">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bill Of Lading Search</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Search BL#</label> <i class="fas fa-eye text-warning float-right" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
            <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='mbl_invoice_search'></label>
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
        <h6 class="m-0 font-weight-bold text-primary">Container Details</h6>
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