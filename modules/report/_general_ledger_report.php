<!--GL REPORT-->
<div class="col-sm-4 mb-1">
    <!-- Approach -->
    <div class="card shadow mb-1">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">GENERAL LEDGER STATEMENT</h6>
        </div>
        <div class="card-body">
            <select class="form-control mb-3 sel_branch_rpt" id="sel_gl_rpt_branch">
                <option>Select Branch</option>
            </select>
            <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_gl_rpt_fdt" autocomplete="off" placeholder="Select First Transaction Date">
            <input type="text" class="form-control form-control-user ep datepicker mb-3" id="text_gl_rpt_ldt" autocomplete="off" placeholder="Select Last Transaction Date">

            <button type="button" class="btn btn-outline-success" id="btn_view_gl_rpt">View Report</button>
        </div>
    </div>
</div>

<!-- Expenditure Report Modal-->
<div class="modal animated--grow-in" id="modalGLRpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">GENERAL LEDGER STATEMENT PREVIEW</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="display_GLRpt">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>