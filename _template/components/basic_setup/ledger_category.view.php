 <!-- Begin Ledger Category Page Content -->
 <div class="container-fluid sub-basic-setup" id="ledger-control-category-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ledger Control Category</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-4 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">New Ledger Category</h6>
      </div>
      <div class="card-body">
        <form class="user">
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0 sr-only">
              <label for="exampleFormControlInput1">Category ID</label>
              <label class="form-control form-control-user label-form-control-user" id="newledgerControlID">101191</label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
              <label for="exampleFormControlInput1">Category Name</label>
              <input type="text" class="form-control form-control-user ep" id="txt-newControlName">
            </div>
          </div>
          <a href="#" class="btn btn-success btn-user btn-block" id="btn-new-control-ledger">
            Add New Category
          </a>
        </form>
      </div>
    </div>

  </div>

  <div class="col-lg-8 mb-4">

    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Existing Ledger Cateory</h6>
      </div>
      <div class="card-body" id="display_new_control_ledger">

      </div>
    </div>

  </div>
</div>

</div>
<!-- /. End of  Ledger Category Content -->