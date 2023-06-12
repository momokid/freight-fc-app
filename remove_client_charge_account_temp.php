
<?php
//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$ID= mysqli_real_escape_string($dbc, $_POST['cid']);


if(!isset($_SESSION['Uname'])){
    header('Location: login');
}elseif($ID==''){
    die('Account details not found');
}else{
    $c=  mysqli_query($dbc, "select * from temp_other_invoice where AccountNo='$ID'");
    
    if(mysqli_num_rows($c)>0){
    
        $b=  mysqli_query($dbc, "delete from temp_other_invoice where AccountNo='$ID'");

            if($b){
                echo '1';
            }else{
                die($ERR);
            }
        
    }
}

?>