<?php

date_default_timezone_set("Europe/London");
$myDate = date("m/d/Y") ;
$myTime = date("m/d/Y h:i:s") ;
$myrealDate = date("Y/m/d h:i:s");
$ajaxDate = date("Y-m-d");
$ajaxTime = date("Y-m-d H:i:s");

$CRC='Error encountered. Contact your system administrator';

function ccdb (){
    
}

#Database connection here....
$dbc = mysqli_connect('localhost','anwar','lagari','supacem') Or die('Cannot Locate Server Port Number. Contact your system administrator');

//$mysqli = new mysqli('localhost','anwar','lagari','pharmdiary');

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>

<?php
/***
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
       // last request was more than 5 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        header('Location: login');
        die("Please log out");
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 300) {
        // session started more than 5 minutes ago
        session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
        $_SESSION['CREATED'] = time();  // update creation time
    }
 * 
 * 
****/

$dayquery=  mysqli_query($dbc, "select * from t_date");

if(mysqli_num_rows($dayquery)==1){
    
    $ac=  mysqli_query($dbc, "select * from user_access_view_0 where Username='$_SESSION[Username]'");

    if(mysqli_num_rows($ac)==1){
            $acn=mysqli_fetch_assoc($ac);
            
            if($acn['Status']=='1'){

            }elseif($acn['Status']=='0'){
            //        echo '<script>alert("cn here '.$_SESSION['Username'].' stats 0")</script>';
                 session_destroy();
                 $_SESSION = [];
                header('Location: signout');
            }
                
    }elseif(mysqli_num_rows ($ac)==0){

    }
}elseif(mysqli_num_rows($dayquery)<>1){
   //Start session
    session_start();

    //End session
    //unset($_SESSION['username']);

    session_destroy();
    $_SESSION = [];
    //echo "login.php";
    header('Location: signout');
}

?>