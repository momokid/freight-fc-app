<!-- Begin Ledger Control Page Content -->
<div class="container-fluid sub-basic-setup" id="user_profile_panel">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                </div>
                <div class="card-body">
                    <form class="">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="exampleFormControlInput1">Full Name</label>
                                <label class="form-control form-control-user label-form-control-user ep"><?php echo $_SESSION['FName'] ?></label>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="exampleFormControlInput1">Profile Type</label>
                                <label class="form-control form-control-user label-form-control-user ep"><?php echo $_SESSION['Nature'] ?></label>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="exampleFormControlInput1">Branch</label>
                                <label class="form-control form-control-user label-form-control-user ep"><?php echo $_SESSION['BranchName'] ?></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <div class="card-body">
                    <form class="">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-4">
                                <label for="exampleFormControlInput1" class="text-danger">* Password is case sensitive. Make sure to type the password the same way when logging in.</label>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0 show_hide_password">
                            <div class="input-group-addon">
                                <label for="exampleFormControlInput1">Old Password </label>
                                    <a><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                                <input type="password" class="form-control form-control-user ep epp" placeholder="Enter Old Password" id="oldUserPassword">
                                
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="exampleFormControlInput1">New Password</label>
                                <input type="password" class="form-control form-control-user ep epp" placeholder="Enter New Password" id="newUserPassword">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="exampleFormControlInput1">Confirm Password</label>
                                <input type="password" class="form-control form-control-user ep epp" placeholder="Confirm New Password" id="confirmNewUserPassword">
                            </div>
                        </div>
                        <a href="#" class="btn btn-warning btn-user btn-block" id="updateUserPassword">
                            Update Password
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /. End of  Ledger Control Page Content -->