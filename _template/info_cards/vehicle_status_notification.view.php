<div class="row <?= !$userAuth['PendingGateOutDashboard'] ? "sr-only" : "" ?>" style="max-height: 30rem;">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE INFO</h6>
                <div class="dropdown no-arrow sr-only">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in sr-only" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something ELSE</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" >
                <div class="card-body" id="display_new_consignment">

                </div>
            </div>
        </div>
    </div>
</div>
