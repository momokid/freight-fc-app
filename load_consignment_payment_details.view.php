<?php
//start the session
session_start();

//Database connection
include('cn/cn.php');

// header("Content-Type: text/event-stream");
// header("Cache-Control: no-cache");
// header("Connection: keep-alive");

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl = mysqli_real_escape_string($dbc, $_POST['id']);
$eta = mysqli_real_escape_string($dbc, $_POST['eta']);
$containerNo = mysqli_real_escape_string($dbc, $_POST['containerNo']);

$a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_chart_0 WHERE BL='$bl' AND ContainerNo='$containerNo'"); 


//Status of disbursement
$status= '';


?>

<div class="alert alert-danger text-danger font-weight-bold alert_danger_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success text-succes font-weight-bold alert_success_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div>

<table class="table table-striped">

    <?php if (mysqli_num_rows($a) > 0) { ?>
        <thead>
            <tr class="fs-6 bg-darf text-white">
                <th scope="col">ACCOUNT NAME</th>
                <th scope="col">AMOUNT PAID</th>
                <th scope="col">PAYMENT DATE</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody>

            <?php while ($an = mysqli_fetch_assoc($a)) { 
            
            $status = $an['Status'];
            ?>
                <tr>
                    <td><?= $an['AccountName']; ?></td>
                    <td><?= formatToCurrency($an['Expenditure']); ?></td>
                    <td><?= formatDate($an['Date']); ?></td>
                    <td><?php setStatusAlert($an['Status']) ?></td>
                </tr>
            <?php } ?>

            <?php if ($eta < 0 ) { //&& $status == 0 ?> 
                <tr>
                    <td><a class="btn btn-dark btn-user text-white p-2 clear-container" data-bl="<?= $bl; ?>" data-container="<?= $containerNo; ?>" >Gate Out</a></td>
                </tr>
            <?php   } ?>


        <?php } else { ?>

            <tr>
                <td>No payment record</td>
            </tr>

        <?php } ?>

        </tbody>
</table>

<script>
    $('.clear-container').click(function() {
        let bl = $.trim($(this).attr("data-bl"));
        let container = $.trim($(this).attr("data-container"));
        let q = confirm("Do you want to confirm Gate Out for this consignment?");
      
        if (q) {
            $.post("update_clear_container_status.php", {
                bl,container
            }, function(response) {
                let data = JSON.parse(response);

                if (data.code == 200) {
                    $('.alert_success_banner').text('Consignment cleared successfully').fadeIn(500).fadeOut(7000);
                    $('.progress-loader').remove();
                    $(`.accordion-${bl}`).hide();
                } else {
                    $('.alert_danger_banner').text(`${data.msg}`).fadeIn(500).fadeOut(7000);
                    $('.progress-loader').remove();
                }
            })
        }
    })
</script>