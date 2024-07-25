<div class="container-fluid sub-basic-setup" id="rcv-service-charge-panel">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Receive Service Charge</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-sm-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4" id="manifestation_breakdown_card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Enter BL #</label>
                            <input type="text" class="form-control form-control-user ep" placeholder="Search BL No." id="service_charge_bl_search">
                            <div id='display_service_charge_bl_search' class='div_search_box'></div>
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Declaration No.</label>
                            <label id="service_charge_declaration_id" class="sr-only ep">id</label>
                            <input type="text" class="form-control form-control-user ep" placeholder="B.O.E #" id="service_charge_decl_no">
                        </div>
                        <div class="col-sm-6 mb-6 mb-sm-0">
                            <label for="exampleFormControlInput1">Item Description</label>
                            <input class="form-control form-control-user ep" id="service_charge_desc" placeholder="Item Description" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Consignee's Name</label>
                            <label id="service_charge_consignee_id" class="sr-only ep">id</label>
                            <input type="text" class="form-control form-control-user ep" id="service_charge_consignee_name" placeholder="Consignee Full Name">
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Amount Charge</label>
                            <input type="number" class="form-control form-control-user ep" id="service_charge_amt_charge" placeholder="" required />
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Select Account</label>
                            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg ep" id="service_charge_sel_cash_acc">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <label for="exampleFormControlInput1">Payment Date</label>
                            <input type="text" class="form-control form-control-user datepicker ep" id="service_charge_pmt_dt">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-3 mb-3 mb-sm-0 sr-only">
                            <label for="exampleFormControlInput1">Transaction ID</label>
                            <label class="form-control form-control-user label-form-control-user ep sr-only" id="service_charge_rcpt_id"></label>
                            <label class="form-control form-control-user label-form-control-user ep" id="service_charge_rcpt_no"></label>
                        </div>
                        <div class="col-sm-12 mb-9 mb-sm-0">
                            <label for="exampleFormControlInput1"></label>
                            <form class="user">
                                <a class="btn btn-success btn-user btn-block" id="btn_save_service_charge">
                                    Save Transaction
                                </a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>