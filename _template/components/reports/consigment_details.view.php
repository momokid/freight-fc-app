 <!-- Begin Cargo manifestation Content -->
 <div class="container-fluid sub-basic-setup" id="new-consignment-details">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Consignment Details Panel</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-sm-8 mb-2">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Consignment Search</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Bill of Lading #</label>
            <label type="text" class="form-control ep" hidden='' id='cns_id_profile_search'></label>
            <input type="text" class="form-control form-control-user ep" id="search_consignment_profile_rpt" placeholder="Enter Bill of Laden/ Carrier/ Vessel Name" autocomplete="off">
            <div id='display_cns_profile_search_info' class='div_search_box'></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-7 mb-2 sr-only">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Options</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
        </div>
        <div class="form-group row">
          <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cosignee_profile_option_details" style="max-height: 200px;overflow-y: scroll;">

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-12 mb-1">
    <!-- Approach -->
    <div class="card shadow mb-1" id="manifestation_breakdown_card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Consignment Details</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-1 mb-sm-0 ep" id="cons_profile_recent_activity">

          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
<!-- /. End of Cargo manifestation Content -->