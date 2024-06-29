<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else { ?>

  <table class="table table-bordered" style="padding:0px;" id="LedgerControlTbl">
    <thead class="thead-dark">
      <tr>
        <th scope="col">VESSEL</th>
        <th scope="col">ETA</th>
        <th scope="col">BILL OF LADING</th>
        <th scope="col">CONT. NO & SIZE</th>
        <th scope="col">P.O.L.</th>
        <th scope="col">WEIGHT (KG)</th>
        <th scope="col">DATE</th>
        <th scope="col">STATUS</th>
      </tr>
    </thead>
    <tbody>


      <?php
      $a = mysqli_query($dbc, "SELECT * FROM container_main_view_1");
      if (mysqli_num_rows($a) > 0) {

        // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
        //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
        while ($an = mysqli_fetch_assoc($a)) { ?>
          <tr class="">
            <td scope="col"><?= $an['VesselName'] ?></td>
            <td scope="col"><?= strftime("$dtf", strtotime($an['ETA'])) ?></td>
            <td scope="col"><?= $an['BL'] ?></td>
            <td scope="col"><?= $an['ContainerNo'] . '/' . $an['ContainerSize'] ?></td>
            <td scope="col"><?= $an['POL_Name'] ?></td>
            <td scope="col"><?= $an['ContWeight'] ?></td>
            <td scope="col"><?= strftime("$dtf", strtotime($an['Date'])) ?></td>
            <td scope="col">

              <?php if ($an['ETA_Days'] >= 4 ) { ?>
                <label class='badge badge-primary'>Pending</label>

              <?php } else if ($an['ETA_Days'] >0) { ?>
                <label class='badge badge-warning'>Pending</label>
                
              <?php } else if ($an['ETA_Days'] == 0) { ?>
                <label class='badge badge-success'>Arrived</label>
                <!-- <select class='form-select form-select-sm'>
                  <option>Assign Officer</option>
                </select> -->
              <?php } else if ($an['ETA_Days'] < 0) { ?>
                <label class='badge badge-danger'>Overdue</label>
                <!-- <select>
                  <option>Assign Officer</option>
                </select> -->

              <?php }

              ?>
            </td>
          </tr>
    <?php }

        echo '</tbody>
             </table>';
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
      //$('#LedgerControlTbl').DataTable();
    </script>