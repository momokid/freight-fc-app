<!-- Begin View Other Report Content -->
<div class="container-fluid sub-basic-setup" id="view-vehicle-report">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Vehicle Mgt. Report Panel</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-sm-3 mb-1">
      <div class="row">
        <!-- Project Card Example -->
        <div class="col-sm-12 mb-2">
          <div class="card shadow mb-2">
            <div class="card-header py-2 bg-success">
              <h6 class="m-0 font-weight-bold text-white">Vehicle Inventory Report</h6>
            </div>
            <div class="card-body">

              <form class="col-sm-12 mb-3 user">
                <a class="btn btn-success btn-user btn-block" id="btn_vehicle_inventory_rpt">
                  View Vehicle Inventory List
                </a>
              </form>

            </div>
          </div>
        </div>

        <div class="col-sm-12 mb-2">
          <!-- Project Card Example -->
          <div class="card shadow mb-2">
            <div class="card-header py-2 bg-danger">
              <h6 class="m-0 font-weight-bold text-white">Disbursement by Container#</h6>
            </div>
            <div class="card-body">

              <div class="form-group row">
                <div class="col-sm-12 mb-1 mb-sm-0">
                  <label for="exampleFormControlInput1">Search Details</label>
                  <label type="text" class="form-control ep" hidden='' id='hbl_id_profile_view_search'></label>
                  <input type="text" class="form-control form-control-user ep" id="text_search_disbursement_details_view" placeholder="Enter Container# || BL#">
                  <div id='display_hbl_handling_cost_view_search_info' class='div_search_box'></div>
                </div>
              </div>

              <div class="form-group row">

                <div class="col-sm-12 mb-1 mb-sm-0">
                  <button type="button" class="btn btn-success" id="btn_disbursement_search_summary_rpt">Search Disburmsement</button>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-sm-9 mb-1">
      <!-- Approach -->
      <div class="card shadow mb-1" id="disbursement_report_view_card">
        <div class="card-header py-2">
          <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <div class="col-sm-12 mb-1 mb-sm-0" id="view_vehicle_preview_result">

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
<!-- /. End of View Other Report Content -->