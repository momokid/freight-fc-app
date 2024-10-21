<!-- Area Chart -->
<div class=" <?= !$userAuth['PendingGateOutDashboard'] ? "sr-only" : "" ?> col-xl-<?= $userAuth['PendingGateOutDashboard'] && $userAuth['CnsAwaitingClearance'] ? '5' : '12' ?> col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">PENDING GATE-OUT CONSIGNMENT</h6>
            <div class="dropdown no-arrow sr-only">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body" style="min-height: 0rem;">
            <div class="card-body" id="display_pending_gate_out_consignment">

                <h2 class="accordion-header placeholder-glow">
                    <span class="placeholder col-4 placeholder-lg bg-dark"></span>
                    <span class="placeholder col-4 placeholder-lg bg-dark"></span>
                    <span class="placeholder col-3 placeholder-lg bg-dark"></span>
                </h2>


                <div class="accordion" id="accordionExample">
                    <h2 class="accordion-header placeholder-glow">
                        <span class="placeholder col-12 placeholder-lg bg-dark"></span>
                    </h2>

                    <h2 class="accordion-header placeholder-glow">
                        <span class="placeholder col-12 placeholder-lg bg-dark"></span>
                    </h2>

                    <h2 class="accordion-header placeholder-glow">
                        <span class="placeholder col-12 placeholder-lg bg-dark"></span>
                    </h2>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Function to fetch data using async/await
    async function fetchData(url, divSection) {
        try {
            const data = await $.ajax({
                url: url, // Replace with your PHP file
                type: 'POST'
            });

            // Update the HTML div with the response from the server
            $(divSection).html(data);
            //alert(data)
        } catch (error) {
            console.error("Failed to fetch data", error);
        }
    }

    // Function to update data every 10 seconds
    function updateData() {
        // $("#display_pending_gate_out_consignment").load("load_gate_out_pending_consignment.php");
       fetchData('load_gate_out_pending_consignment.php', '#display_pending_gate_out_consignment');
    }

    // Call updateData every 10 seconds
    setInterval(updateData, 5000);
</script>