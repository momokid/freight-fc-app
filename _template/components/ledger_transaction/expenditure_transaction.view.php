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