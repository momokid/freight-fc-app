<?php
//start the session
session_start();

//session_destroy();
$_SESSION = array();


if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
}else{
	die();
}

?>