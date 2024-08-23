 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-driver-registration-panel">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">New Driver Registration</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Content Column -->
         <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Driver Details</h6>
                 </div>
                 <div class="card-body">

                     <div class="form-group row">

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">First Name*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_fname">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Last Name*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_lname">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Driver's License#*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_license">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Address*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_address">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Telephone Number*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_telno">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Previous Experience*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_driver_former_employer">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Employment Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_driver_employment_date">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Vehicle Assigned*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_driver_vehicle_assigned">
                                 <option></option>
                             </select>
                         </div>
                         <form class="col-sm-4 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-primary btn-user btn-block" id="btn_new_driver_registration">
                                 Add New Driver
                             </a>
                         </form>

                     </div>
                 </div>
             </div>

         </div>

         <div class="col-lg-12 mb-4">
             <!-- Approach -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Registered Driver Details</h6>
                 </div>
                 <div class="card-body" id="display_registered_driver">

                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /. End of New consignmentContent -->