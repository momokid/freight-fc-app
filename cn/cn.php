<?php

date_default_timezone_set('Europe/London');
$myDate = date('m/d/Y');
$myTime = date('m/d/Y h:i:s');
$myrealDate = date('Y/m/d h:i:s');
$ajaxDate = date('Y-m-d');
$ajaxTime = date('Y-m-d H:i:s');
$Crnc = 'GHC';
$PixDir = 'img/members/';
$CRC = 'Error encountered. Contact your system administrator';
$ERR =
  'This process has encountered an error. Contact your system administrator.';
$loc = 'http://localhost/app-freight-diary';
$logo_ext = '.png';
$fasm = 'font-awesome-4.7.0';
#Database connection here....
($dbc = mysqli_connect('localhost', 'root', '123456', 'app-freight')) or
  die('Cannot Locate Server Port Number. Contact your system administrator');
$dtf = '%b %d, %Y';
//$mysqli = new mysqli('localhost','anwar','lagari','app_freight');

//Dont cache witht this code
//header("Cache-Control: no-cache, must-revalidate");
$imgloc = "url('http://localhost/app-freight-diary/img/logo.png')";

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<?php
function auto_version($file = '')
{
  if (!file_exists($file)) {
    return $file;
  }
  $mtime = filemtime($file);
  return $file . '?' . $mtime;
}

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

//Database class for api
class Database
{
  //DB Params
  private $host = 'localhost';
  private $db_name = 'app-freight';
  private $username = 'root';
  private $password = '123456';
  private $conn;

  //DB Connect
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO(
        'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
        $this->username,
        $this->password
      );
      $this->conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
      );
    } catch (PDOException $e) {
      echo 'Connection Error:' . $e->getMessage();
    }

    return $this->conn;
  }
}

function ordinal($num)
{
  $last = substr($num, -1);
  if ($last > 3 or $last == 0 or $num >= 11 and $num <= 19) {
    $ext = 'th';
  } elseif ($last == 3) {
    $ext = 'rd';
  } elseif ($last == 2) {
    $ext = 'nd';
  } else {
    $ext = 'st';
  }
  return $num . $ext;
}
