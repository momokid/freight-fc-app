<!-- Begin View Other Report Content -->
<div class="container-fluid sub-basic-setup" id="view-disbursement-report">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Disbursement Report Panel</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-sm-5 mb-1">
    <div class="row">
      <!-- Project Card Example -->
      <div class="col-sm-12 mb-2">
        <div class="card shadow mb-2">
          <div class="card-header py-2 bg-success">
            <h6 class="m-0 font-weight-bold text-white">Summary Disbursement Report</h6>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-12 mb-1 mb-sm-0">
                <input type="text" class="form-control form-control-user ep datepicker" id="sel_disbursement_summary_fdate" placeholder="Select First Date">
              </div>
            </div>

            <div class="form-group row">
             
              <div class="col-sm-12 mb-1 mb-sm-0">
                <input type="text" class="form-control form-control-user ep datepicker" id="sel_disbursement_summary_ldate" placeholder="Select Last Date">
              </div>
            </div>

            <div class="form-group row">
             
              <div class="col-sm-12 mb-1 mb-sm-0">
                <button type="button" class="btn btn-success" id="btn_disbursement_summary_rpt">View Report</button>
              </div>
            </div>


          </div>
        </div>
      </div>

      <div class="col-sm-12 mb-2">
        <!-- Project Card Example -->
        <div class="card shadow mb-2">
          <div class="card-header py-2 bg-danger">
            <h6 class="m-0 font-weight-bold text-white">Handling Cost Income View</h6>
          </div>
          <div class="card-body">

            <div class="form-group row">
              <div class="col-sm-12 mb-1 mb-sm-0">
                <label for="exampleFormControlInput1">House BL#</label>
                <label type="text" class="form-control ep" hidden='' id='hbl_id_profile_view_search'></label>
                <input type="text" class="form-control form-control-user ep" id="search_housebl_profile_handling_cost_view" placeholder="Enter House BL# or Client Name">
                <div id='display_hbl_handling_cost_view_search_info' class='div_search_box'></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-sm-7 mb-1">
    <!-- Approach -->
    <div class="card shadow mb-1" id="disbursement_report_view_card">
      <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-1 mb-sm-0" id="view_other_report_search_result">

          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
<!-- /. End of View Other Report Content -->