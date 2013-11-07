<?php

dbconnect();
$url = "";
//retrieve our data from POST
$l1 = mysql_real_escape_string($_POST['line_01']);
$l2 = mysql_real_escape_string($_POST['line_02']);
$l3 = mysql_real_escape_string($_POST['line_03']);
$l4 = mysql_real_escape_string($_POST['line_04']);
$l5 = mysql_real_escape_string($_POST['line_05']);
$l6 = mysql_real_escape_string($_POST['line_06']);
$l7 = mysql_real_escape_string($_POST['line_07']);
$pass1 = $_POST['password'];
$pass2 = "samplePassword";
if($pass1 != $pass2) {
    header('Location: newEvent.php?error=Incorrect password.');
	exit;
}


$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
  {
    header('Location: newEvent.php?error=Return Code: ' . $_FILES["file"]["error"]);
	exit;
  }else{
	if (file_exists("upload/" . $_FILES["file"]["name"])){
      header('Location: newEvent.php?error='.$_FILES["file"]["name"].' already exists. ');
	  exit;
    }else{
    #  header("Location: newEvent.php?success=Upload: " . $_FILES["file"]["name"] . "<br>Type: " 
	#  												   . $_FILES["file"]["type"] . "<br>Size: " 
	#												   . ($_FILES["file"]["size"] / 1024) . " kB<br>Temp file: " 
	#												   . $_FILES["file"]["tmp_name"] . "<br>Stored in: " . "upload/" .
	#												    $_FILES["file"]["name"]);
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      $url = "upload/" . $_FILES["file"]["name"];
    }
  }
}else{
  header('Location: newEvent.php?error=Invalid file.');
  exit;
}
  


// Insert into users
$query = "INSERT INTO Events ( image_url, presenting_group, event_name, day, time, general_price, special_price, note)
        VALUES ( '$url' , '$l1','$l2','$l3','$l4','$l5','$l6','$l7' );";
mysql_query($query) or die(mysql_error());

mysql_close();
header('Location: newEvent.php');
exit;

function dbconnect() {
	$dbhost = 'leadershipAppDat.db.10164554.hostedresource.com';
	$dbname = 'leadershipAppDat';
	$dbuser = 'leadershipAppDat';
	$dbpass = 'N!SFlG9f97ab98';
	mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to database");
	mysql_select_db($dbname);
}
?>