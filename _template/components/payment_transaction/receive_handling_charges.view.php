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
            <input type="text" class="form-control form-control-user ep" id="consignee_invoice_payment" autocomplete="off">
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