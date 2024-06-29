<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$mbl =  (trim(mysqli_real_escape_string($dbc, $_POST['mbl'])));


if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else {
  $a = mysqli_query($dbc, "SELECT * FROM container_main_view_3 WHERE BL='$mbl'");
?>

  <table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
    <thead class="thead-dark">
      <tr>
        <th scope="col">SHIPPER</th>
        <th scope="col">BL#</th>
        <th scope="col">ETA</th>
        <th scope="col">WEIGHT (KG)</th>
        <th scope="col">OFFICER</th>
      </tr>
    </thead>
    <tbody>

      <?php if (mysqli_num_rows($a) == 1) {

        //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
        while ($an = mysqli_fetch_assoc($a)) { ?>
          
          <tr>
            <td scope="col"><?= $an['ShipperName'] ?> </td>
            <td scope="col"><?= $an['BL'] ?> </td>
            <td scope="col"><?= strftime("$dtf", strtotime($an['Date'])) ?></td>
            <td scope="col"><?= formatNumber($an['ContWeight']); ?> </td>
            <td scope="col"><?= $an['OfficerAssignedName'] ?> </td>
          </tr>
        <?php   } ?>

    </tbody>
  </table>
<?php }
    }
?>

<style>
  .thead-lig {
    background: green;
    color: white;
  }

  .table-r0:hover {
    background: black;
    color: white;
    cursor: pointer;
  }
</style>

<script>
  $(document).ready(function() {

  });
</script>