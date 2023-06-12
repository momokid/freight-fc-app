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
} else {
  $a = mysqli_query($dbc, "select * from  ledger_account_view where Status='1'");


  if (mysqli_num_rows($a) == 0) {
    echo '<table class="table table-striped table-dark table-responsive" style="padding:0px;" id="LedgerAccountTbl">
           
                    <thead class="thead-lig">
                      <tr>
                        <th scope="col">CONTROL NAME</th>
                        <th scope="col">ACCOUNT NO.</th>
                        <th scope="col">ACCOUNT NAME</th>
                        <th scope="col">ACCOUNT TYPE</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>';
  } else {

    // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
    echo '<table class="table table-bordered" id="LedgerAccountTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">CONTROL NAME</th>
                        <th scope="col">ACCOUNT NO.</th>
                        <th scope="col">ACCOUNT NAME</th>
                        <th scope="col">ACCOUNT TYPE</th>
                      </tr>
                    </thead>
                    <tbody>';
    //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
    while ($an = mysqli_fetch_assoc($a)) {
      echo '
                <tr class="tr-table-details">
                  <td scope="col"><b>' . $an['ControlName'] . '</b></td>
                  <td scope="col">' . $an['AccountNo'] . '</td>
                  <td scope="col">' . $an['AccountName'] . '</td>
                  <td scope="col">' . $an['Type'] . '</td>
                </tr> ';
    }

    echo '</tbody>
             </table>';
  }
}
?>

<style>
  .tr-table-details:hover {
    background: green;
    color: white;
    cursor: pointer;
  }
</style>

<script>
  $(document).ready(function() {
    $('#LedgerAccountTbl').DataTable();
  });
</script>