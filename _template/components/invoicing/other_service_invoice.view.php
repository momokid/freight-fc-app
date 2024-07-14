        <!-- Begin Cargo manifestation Content -->
        <div class="container-fluid sub-basic-setup" id="new-other-serv-invoice-panel">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Other Service Invoice</h1>
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
                      <label for="exampleFormControlInput1">Search Client Name</label> <i class="fas fa-plus text-danger float-right ml-3 addNewConsignee" data-toggle="modal" data-target="#newConsigneeModal" id="addCleintModal"></i><i class="fas fa-eye text-warning float-right sr-only" data-toggle="modal" data-target="#consigneeInProcessModal" id="load_consignee_in_process_others"></i>
                      <label type="text" class="form-control ep sr-only" id='search_client_oth_serv_id'></label>
                      <input type="text" class="form-control form-control-user ep client-det-search" id='search_client_other_invoice' autocomplete="off" placeholder="">
                      <div id='display_hBL_invoicing_search_info' class='div_search_box client-search-show'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-7 mb-2">
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

            <div class="col-sm-5 mb-4">
              <!-- Approach -->
              <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Additional Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">D.O.T</label>
                      <input type="text" class="form-control form-control-user ep datepicker" id="client_dot_invoice" autocomplete="off" placeholder="">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Transaction ID</label>
                      <label class="form-control form-control-user label-form-control-user ep sr-only" id="client_rcpt_id_invoice"></label>
                      <label class="form-control form-control-user label-form-control-user ep" id="client_rcpt_no_invoice"></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Select Account</label>
                      <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="sel_ots_acc_invoice">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Amount</label>
                      <input type="number" class="form-control form-control-user ep epp" id="client_amt_invoice">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="exampleFormControlInput1">Description</label>
                      <input type="text" class="form-control form-control-user ep epp" id="client_desc_invoice">
                    </div>
                  </div>

                  <div class="form-group row">

                    <button class="btn btn-success btn-user btn-block p-2" style="border-radius: 50px;" id="btn_add_charge_client_invoice">
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

            <div class="col-sm-7 mb-1">
              <!-- Approach -->
              <div class="card shadow mb-1" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Handling Charges</h6>
                </div>
                <div class="card-body">

                  <div class="form-group row">
                    <div class="col-sm-12 mb-1 mb-sm-0 ep" id="client_charges_display_details">

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /. End of Cargo manifestation Content -->