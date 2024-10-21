<div class="row <?= !$userAuth['VehicleHubDashboard'] ? "sr-only" : "" ?>" style="max-height: 30rem;">
    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">VEHICLE INFO</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="card-body" id="display_vehicle_hub_data">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div>

</div>

<script>
    //  vehicle incident data
    async function fetchVehicleIncident() {
        try {
            const response = await fetch('vehicle_incident_report.chart.php'); // PHP script URL
            const data = await response.json();
            return data; // Return the fetched data
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // create the bar chart function
    async function vehicleIncidentChart() {
        const Incident = await fetchVehicleIncident();

        // Prepare data for the chart
        const incidentType = Incident.map(item => item.incident_type);
        const incidentCount = Incident.map(item => item.count);

        const ctx = document.getElementById('myChart');
        const vehicleUtilizationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: incidentType,
                datasets: [{
                    label: 'Vehicle Incident Report',
                    data: incidentCount,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    }

    //initial function
    vehicleIncidentChart()

    // const ctx = document.getElementById('myChart');
    // let myLabel = [];
    // let myData = [];
    // let keyValuePairs = [];

    // fetch('vehicle_incident_report.chart.php').then(response => response.json())
    //     .then(data => {
    //         // let res = JSON.parse(data);
    //         // console.log(data);

    //         data.forEach(item => {

    //             const key = (item.incident_type); // Use incident_type as key
    //             const value = Number(item.count);

    //             myLabel.push(key);
    //             myData.push(value);

    //             keyValuePairs.push([key]);

    //         });

    //         console.error(myLabel);

    //         new Chart(ctx, {
    //             type: 'bar',
    //             data: {
    //                 labels: myLabel,
    //                 datasets: [{
    //                     label: 'VEHICULAR INCIDENT',
    //                     data: myData,
    //                     backgroundColor: 'rgba(75, 192, 192, 0.2)',
    //                     borderColor: 'rgba(75, 192, 192, 1)',
    //                     borderWidth: 1
    //                 }]
    //             },
    //             options: {
    //                 scales: {
    //                     y: {
    //                         beginAtZero: true
    //                     }
    //                 }
    //             }
    //         });

    //console.log(`${myLabel}, ${myData}`);
    //incidentData.addRows([keyValuePairs]);

    // keyValuePairs.forEach(incident => {
    //     incidentData.addRows(incident)
    //     console.log("Showuiing inceing")
    //     console.log(incident)
    // })

    //        });
</script>