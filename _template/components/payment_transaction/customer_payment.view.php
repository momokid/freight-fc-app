<!-- Begin Receive Declaration Charges Content -->
<div class="container-fluid sub-basic-setup" id="rcv-customer-payment-panel">

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
            <input type="text" class="form-control form-control-user ep" placeholder="Search BL No." id="dclr_prcs_bl_search" autocomplete="off">
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