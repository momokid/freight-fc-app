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
} else {
  $a = mysqli_query($dbc, "select * from temp_mainbl_new_consignee where Username='$Uname'");


  if (mysqli_num_rows($a) == 0) {
    echo '<div class="table-responsive"><table class="table table-bordered" style="padding:0px;" id="dataTables">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">SHIPPER</th>
                        <th scope="col">VESSEL NAME</th>
                        <th scope="col">MAIN BL</th>
                        <th scope="col">CONTAINER NO/SIZE</th>
                        <th scope="col">WEIGHT</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table></div>';
  } else {

    // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
    echo '<div class="table-responsive">
                 <table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">SHIPPER</th>
                        <th scope="col">VESSEL NAME</th>
                        <th scope="col">MAIN BL</th>
                        <th scope="col">CONTAINER NO/SIZE</th>
                        <th scope="col">WEIGHT</th>
                      </tr>
                    </thead>
                   <tbody>';
    //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
    while ($an = mysqli_fetch_assoc($a)) {
      echo '
                <tr>
                  <td scope="col">' . $an['ShipperName'] . '</td>
                  <td scope="col">' . $an['VesselName'] . '</td>
                  <td scope="col">' . $an['MainBL'] . '</td>
                  <td scope="col">' . $an['ContainerNo'] . '/' . $an['ContainerSize'] . '</td>
                  <td scope="col">' . number_format($an['ContWeight'], 2, '.', ',') . '</td>
                </tr> ';
    }

    echo '</tbody>
             </table></div>';
  }
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