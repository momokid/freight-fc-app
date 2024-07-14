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