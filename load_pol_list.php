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
   $a = mysqli_query($dbc, "select * from  pol order by POL_Name asc");
   
  
   if(mysqli_num_rows($a)==0){
       echo '<table class="table table-bordered" style="padding:0px;" id="dataTables">
                    <thead class="thead-lig">
                      <tr>
                        <th scope="col">P.O.L. ID</th>
                        <th scope="col">P.O.L. NAME</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>';
   }else{
      
  // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
             echo '<table class="table table-bordered" style="padding:0px;" id="POLTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">P.O.L. ID</th>
                        <th scope="col">P.O.L. NAME</th>
                      </tr>
                    </thead>
                    <tbody>';
       //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
         while($an = mysqli_fetch_assoc($a)){
            echo '
                <tr>
                  <td scope="col">'.$an['POL_ID'].'</td>
                  <td scope="col">'.$an['POL_Name'].' <i class="fa fa-trash"></i></td>
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
        $('#POLTbl').DataTable();
    });
</script>