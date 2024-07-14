 <!-- Begin Cargo manifestation Content -->
 <div class="container-fluid sub-basic-setup" id="new-non-manifest-invoice-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Non-BL Invoice</h1>
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