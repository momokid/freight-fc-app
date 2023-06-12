<?php



//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
	
}elseif(!isset($_SESSION['BranchID'])){
	header('Location: login');
}

                $a = mysqli_query($dbc, "select * from t_date");
                if(mysqli_num_rows($a)==0){
                    
                }else{
                    $an = mysqli_fetch_assoc($a);
                   // $Uname = trim(mysqli_real_escape_string($dbc, $_SESSION['Uname']));
                   // $Init= trim(mysqli_real_escape_string($dbc, $_SESSION['Init']));
                    $Date = trim(mysqli_real_escape_string($dbc, strftime('%d%m%Y',strtotime($ajaxDate))));
                    $Date1 = trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d',strtotime($ajaxDate))));
                    $Time1 = trim(mysqli_real_escape_string($dbc, $ajaxTime));
                    $BranchID= trim(mysqli_real_escape_string($dbc, $_SESSION['BranchID']));


                    $result = mysqli_query($dbc, "select * from receipt_main where Date='$Date1' and Username='$Uname'");

                    if(mysqli_num_rows($result)==0){
                            echo trim('1');
                    }elseif(mysqli_num_rows($result)>0){
                            $result1 = mysqli_query($dbc, "select max(ID) as ID from receipt_main where Date='$Date1' and Username='$Uname'");

                            $Ref = mysqli_fetch_assoc($result1);
                            $ID = trim($Ref['ID']+1);

                            echo trim($ID);
                    }
 
                }
	
		
	
	
?>