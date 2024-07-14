<!-- Begin Edit Consignment Weights Content -->
<div class="container-fluid sub-basic-setup" id="edit-consignment-weight">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Consignment Weight</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-sm-12 mb-2">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-success">
        <h6 class="m-0 font-weight-bold text-white">Consignment Search</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Bill of Lading #</label>
            <label type="text" class="form-control ep" hidden='' id='cns_id_wieght_edit_search'></label>
            <input type="text" class="form-control form-control-user ep" id="search_consignment_weight_edit" placeholder="Enter Main BL">
            <div id='display_cns_weight_edit_info' class='div_search_box'></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-12 mb-1">
    <!-- Approach -->
    <div class="card shadow mb-1" id="manifestation_breakdown_card">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <div class="col-sm-12 mb-1 mb-sm-0" id="cons_wieght_edit_search_result">

          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
<!-- /. End of Edit Consignment Weight Content -->