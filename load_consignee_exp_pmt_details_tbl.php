<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns= mysqli_real_escape_string($dbc,$_POST['cns']);
$mbl= mysqli_real_escape_string($dbc,$_POST['mbl']);

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
   $a = mysqli_query($dbc, "select * from container_exp_pmt_3 where ConsignmentID='$cns' and MainBL='$mbl'");
   
  
   if(mysqli_num_rows($a)==0){
       echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">TOTAL CHARGES</th>
                        <th scope="col">TOTAL TAXES</th>
                        <th scope="col">CHARGES PAID</th>
                        <th scope="col">CHARGES OUTSTANDING</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>';
   }else{
      
  // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
             echo '<table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">TOTAL CHARGES</th>
                        <th scope="col">TOTAL TAXES</th>
                        <th scope="col">CHARGES PAID</th>
                        <th scope="col">CHARGES OUTSTANDING</th>
                      </tr>
                    </thead>
                   <tbody>';
       //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
         while($an = mysqli_fetch_assoc($a)){
            echo '
                <tr>
                  <td scope="col" class="text-danger">'.number_format($an['TFee'],2,'.',',').'</td>
                  <td scope="col">'.number_format($an['GTFVal']+$an['VATVal'],2,'.',',').'</td>
                  <td scope="col" class="text-danger">'.number_format($an['TDr'],2,'.',',').'</td>
                  <td scope="col" class="text-danger">'.number_format($an['Balance'],2,'.',',').'</td>
                </tr> '; 
            
         }
      
         echo '</tbody>
             </table>';
       
        }
       
   
  
}
?>

<style>
.thead-lig{
   background:green;
   color:white;
}
.table-r0:hover{
    background: black;
    color: white;
    cursor: pointer;
}
</style>

<script>
    $(document).ready(function() {
       
    });
</script>