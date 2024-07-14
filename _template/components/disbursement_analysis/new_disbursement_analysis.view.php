        <!-- Begin Disbursement Analysis Content -->
        <div class="container-fluid sub-basic-setup" id="disbursement-analysis-panel">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Disbursement Analysis</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-sm-5 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disbursement Search Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Search By Main BL</label> <i class="fas fa-broom text-danger float-right" title="Clear disbursment analysis" id="clearDisbursementAnalysis"></i> <i class="fas fa-eye text-primary float-right" title="View disbursment analysis" id="viewDisbursementAnalysis"></i>
                      <label type="text" class="form-control ep lbl-client-search-id" hidden='' id='seach_hbl_invoicing_consignee'></label>
                      <input type="text" class="form-control form-control-user ep" id="txt_disbursement_bl_search" autocomplete="off" placeholder="Enter BL #">
                      <div id='disbursement_search_info' class='div_search_box'></div>
                      <div id="recent_disbursement_bl"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Main BL Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="disbursement_fcl_bl_display_details">

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Summary</h6>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Total Cash Revenue</label>
                      <input type="number" class="form-control form-control-user ep" autocomplete="off" placeholder="Enter Cash Revenue" id="txtTotalDisbursementIncome">

                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Balance Outstanding</label>
                      <label class="form-control form-control-user label-form-control-user" id="lblTotalDisbursement"></label>
                    </div>
                  </div>
                  <div class="form-group row mt-3">

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Receipt No.</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_rcpt_id_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_hblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="hBL_mblid_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="hBL_rcpt_no_invoice"></label>
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Date of Transaction</label>
                      <input type="text" class="form-control form-control-user datepicker ep" autocomplete="off" id="txt_disbursement_DOT">
                    </div>

                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">
                      <form class="user">
                        <a class="btn btn-success btn-user btn-block" id="btn_save_disbursement">
                          Save Disbursement
                        </a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="disbursement_analysis_display_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disbursement Account Details</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="disbursement_fcl_account_display">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Disbursement Analysis Content -->