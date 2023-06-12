<?php
//start the session
session_start();

//session_destroy();
$_SESSION = [];

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc,$_POST['Uname']);
$UPass= mysqli_real_escape_string($dbc,$_POST['Pass']);

     
    if(strpos($Uname, ";")){
        die("Invalid Username");
    }elseif(strpos($UPass, ";")){
        die();
    }else{
        $a = mysqli_query($dbc, "select * from kaina_view where ID='$Uname' and Password='$UPass'");
        
        if(mysqli_num_rows($a)==1){
            $an = mysqli_fetch_assoc($a);
            
            if($an['ID']==$Uname and $an['Password']==$UPass){
                if($an['Stats']==0){
                    echo "<script>Account is disabled. Contact your system administrator</script>";
                }else{
                    if($an['Nature']=='Admin-0'){
                        $_SESSION['Uname']=trim($Uname);
                        $_SESSION['UPass']=trim($UPass);
                        $_SESSION['FName']=trim($an['FullName']);
                        $_SESSION['Initial']=trim($an['Initial']);
                        $_SESSION['CLID']=trim($an['ClassrmID']);
                        $_SESSION['Pic']=trim($an['Picture']);
                        $_SESSION['BranchID']=trim($an['BranchID']);

                      //  header('Location: my-online-platform-0026201803');
                        echo "admin-model";   
                    }
                }
                 
            }else{
               echo 1;
            }
        }else{
            echo 1;
        }
    }
    
    

?>