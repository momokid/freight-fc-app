<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);
$mbl = mysqli_real_escape_string($dbc, $_POST['mbl']);

if (!isset($_SESSION['Uname'])) {
  header('Location: login');
} else { ?>

  <table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
    <thead class="thead-dark">
      <tr>
        <th scope="col">MAIN BL #</th>
        <th scope="col">CONSIGNEE NAME</th>
        <th scope="col">CONSTAINER SIZE</th>
        <th scope="col">OFFICER ASSIGNED </th>
      </tr>
    </thead>
    <tbody>


    <?php $a = mysqli_query($dbc, "SELECT * FROM container_main_view_3 WHERE ConsigneeID='$cns' AND BL='$mbl'");


    if (mysqli_num_rows($a) > 0) {

   //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
      while ($an = mysqli_fetch_assoc($a)) {
        echo '
                <tr>
                  <td scope="col">' . $an['BL'] . '</td>
                  <td scope="col">' . $an['ConsigneeName'] . '</td>
                  <td scope="col">' . $an['ContainerSize']. 'ft</td>
                  <td scope="col">' . $an['OfficerAssignedName'] . '</td>
                </tr> ';
      }

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
      $(document).ready(function() {

      });
    </script>