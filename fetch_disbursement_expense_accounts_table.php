<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
  
       $a = mysqli_query($dbc, "select * from handling_charge_view order by PaymentOrder, AccountName");
        if(mysqli_num_rows($a)==0){
            echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
                         <thead class="thead-lig">
                           <tr>
                             <th scope="col">ACCOUNT NAME</th>
                             <th scope="col">AMOUNT</th>
                             <th scope="col"></th>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>';
        }else{

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
        $('#HandlingChargeTbls').DataTable();
     
    });
</script>