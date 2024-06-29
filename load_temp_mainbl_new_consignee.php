<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e = mysqli_real_escape_string($dbc, $_POST['cns']);

if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else { ?>

  <div class="table-responsive">
    <table class="table table-bordered" style="padding:0px;" id="dataTables">
      <thead class="thead-dark">
        <tr>
          <th scope="col">SHIPPER</th>
          <th scope="col">MAIN BL</th>
          <th scope="col">CONTAINER NO/SIZE</th>
          <th scope="col">WEIGHT</th>
          <th scope="col">OFFICE ASSIGNED</th>

        </tr>
      </thead>
      <tbody>

        <?php

        $a = mysqli_query($dbc, "select * from temp_mainbl_new_consignee where Username='$Uname'");
        $mbl = "";

        if (mysqli_num_rows($a) > 0) {
          while ($an = mysqli_fetch_assoc($a)) { ?>
  
            <tr>
              <td scope="col"><?= $an['ShipperName'] ?> </td>
              <td scope="col"><?= $an['MainBL']  ?></td>
              <td scope="col"><?= $an['ContainerNo'] . '/' . $an['ContainerSize']  ?></td>
              <td scope="col"><?= number_format($an['ContWeight'], 2, '.', ',')  ?></td>
              <td scope="col" class="text-primary font-weight-bold"><?= $an['OfficerAssignedName']  ?></td>
            </tr>
          <?php } ?>

      </tbody>
    </table>
  </div>
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