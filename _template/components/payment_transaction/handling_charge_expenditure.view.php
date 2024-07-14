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
            <input type="text" class="form-control form-control-user ep" id="consignee_invoice_rcv" autocomplete="off">
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
