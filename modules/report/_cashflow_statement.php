<!--cashflow REPORT-->
<div class="col-sm-4 mb-1">
    <!-- Approach -->
    <div class="card shadow mb-1">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">CASH FLOW STATEMENT</h6>
        </div>
        <div class="card-body">
            <select class="form-control mb-3 sel_branch_rpt" id="sel_cashflow_sttmnt_branch" disabled>
                <option></option>
            </select>
            <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_cashflow_sttmnt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
            <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_cashflow_sttmnt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

            <button type="button" class="btn btn-outline-success" id="btn_view_cashflow_sttmnt" data-toggle="modal" data-target="#modalCashFlowSttmnt">View Report</button>
        </div>
    </div>
</div>

<!-- cashflow Report Modal-->
<div class="modal animated--grow-in" id="modalCashFlowSttmnt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">CASH FLOW STATEMENT PREVIEW</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="display_cashflowSttmnt">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>