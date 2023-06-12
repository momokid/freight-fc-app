<?php



//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$bl=  trim(mysqli_real_escape_string($dbc, $_POST['bl']));
$status=  trim(mysqli_real_escape_string($dbc, $_POST['status']));
$status_code=  trim(mysqli_real_escape_string($dbc, $_POST['status_code']));
$newETA=  trim(mysqli_real_escape_string($dbc, strftime('%Y-%m-%d',strtotime($_POST['newETA']))));

if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
	
}elseif(!isset($_SESSION['BranchID'])){
	header('Location: login');
}else if(!$_POST['bl']){
	echo json_encode(array('code'=>500,'msg'=>'Main BL not found.'));
}else if(!$_POST['newETA']){
	echo json_encode(array('code'=>500,'msg'=>'ETA not found.'));
}else{
	$a = mysqli_query($dbc, "SELECT * from eta_web_track where MainBL='$bl'");

	if(mysqli_num_rows($a)<>1){
		echo json_encode(array('code'=>500,'msg'=>'Cannot process multiple Main BL'));
	}else{
		$b = mysqli_query($dbc,"UPDATE eta_web_track set ETA='$newETA', Status='$status_code' WHERE MainBL='$bl'");

		if($b){
			echo json_encode(array('code'=>200,'msg'=>'Records updated successfully.'));
		}else{
			echo json_encode(array('code'=>500,'msg'=>'Records not updated successfully.'));
		}
	}
}




?>