        <!-- Begin Disbursement Analysis Content -->
        <div class="container-fluid sub-basic-setup" id="gate-out-expense-panel">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gate-Out Expense</h1>
            </div>

            <!-- Content Row -->
            <div class="row">


                <div class="col-sm-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4" id="manifestation_breakdown_card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gate-Out Expense Transaction</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Consignment Details</label>
                                    <select class="custom-select custom-select-sm sl-form-ctrl form-control" title="Select Cash Source" id="txtGateOutConsignmentDetails">
                                    </select>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Expense Account</label>
                                    <select class="custom-select custom-select-sm sl-form-ctrl form-control" title="Select Cash Source" id="txtGateOutExpenseAcc">
                                    </select>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Amount</label>
                                    <input type="number" class="form-control form-control-user ep" autocomplete="off" id="txtGateOutExpenseAmount">
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Cash Source</label>
                                    <select class="custom-select custom-select-sm sl-form-ctrl form-control" title="Select Cash Source" id="txtGateOutCrAccount">
                                    </select>
                                </div>


                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Transaction Description</label>
                                    <input type="text" class="form-control form-control-user ep" autocomplete="off" id="txtGateOutDescription">
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="exampleFormControlInput1">Date of Transaction</label>
                                    <input type="text" class="form-control form-control-user datepicker ep" autocomplete="off" id="txtGateOutDOT">
                                </div>


                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0" id="cosignee_house_bl_display_details">
                                    <form class="user">
                                        <a class="btn btn-success btn-user btn-block" id="btnSaveGateOutExpense">
                                            Save Disbursement
                                        </a>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- /. End of Disbursement Analysis Content -->