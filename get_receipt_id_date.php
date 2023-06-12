<?php



//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$dt=  trim(mysqli_real_escape_string($dbc, strftime('%d%m%Y',strtotime($_POST['dt']))));
$dt1=  trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d',strtotime($_POST['dt']))));

if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
	
}elseif(!isset($_SESSION['BranchID'])){
	header('Location: login');
}

        // $Uname = trim(mysqli_real_escape_string($dbc, $_SESSION['Uname']));
       // $Init= trim(mysqli_real_escape_string($dbc, $_SESSION['Init']));
       // $Date = trim(mysqli_real_escape_string($dbc, strftime('%d%m%Y',strtotime($an['ActiveDate']))));
       // $Date1 = trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d',strtotime($an['ActiveDate']))));
      //  $Time1 = trim(mysqli_real_escape_string($dbc, $ajaxTime));
      //  $BranchID= trim(mysqli_real_escape_string($dbc, $_SESSION['BranchID']));


        $result = mysqli_query($dbc, "select * from receipt_main where Date='$dt1' and Username='$Uname'");

        if(mysqli_num_rows($result)==0){
                echo trim('1');
        }elseif(mysqli_num_rows($result)>0){
                $result1 = mysqli_query($dbc, "select max(ID) as ID from receipt_main where Date='$dt1' and Username='$Uname'");

                $Ref = mysqli_fetch_assoc($result1);
                $ID = trim($Ref['ID']+1);

                echo trim($ID);
        }
 	
?>