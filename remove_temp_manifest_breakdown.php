
<?php
//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$ID= mysqli_real_escape_string($dbc, $_POST['hbl']);
$BL= mysqli_real_escape_string($dbc, $_POST['mbl']);

if($ID==''){
    die('House BL details not found');
}else{
    $c=  mysqli_query($dbc, "select * from temp_manifestation_breakdown where HouseBL='$ID' and MainBL='$BL'");
    
    if(mysqli_num_rows($c)>0){
    
        $b=  mysqli_query($dbc, "delete from  temp_manifestation_breakdown where HouseBL='$ID' and MainBL='$BL'");

            if($b){
                echo '1';
            }else{
                die($ERR);
            }
        
    }else{
        die('Record not found');
    }
}

?>