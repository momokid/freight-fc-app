 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-truck-expenditure-panel">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Vehicle Expenditure</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Content Column -->
         <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Expenditure Details</h6>
                 </div>
                 <div class="card-body">

                     <div class="form-group row">

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Vehicle*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_expenditure_vehicle">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Expenditure Type*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_expenditure_expense_type">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Expenditure Amount*</label>
                             <input type="number" class="form-control form-control-user ef" id="new_expenditure_amount">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Expenditure Account*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_expenditure_account">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Credit Account*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_expenditure_debit_account">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Description*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_expenditure_description">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Vendor/Supplier*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_expenditure_vendor">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Transaction Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_expenditure_tdate">
                         </div>
                         <form class="col-sm-12 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-danger btn-user btn-block" id="btn_new_vehicle_expenditure">
                                 Save Transaction
                             </a>
                         </form>

                     </div>
                 </div>
             </div>

         </div>

     </div>

 </div>
 <!-- /. End of New consignmentContent -->