<?php
include 'security.php';
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
if(isCorrectPassword($pass1)) {
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
?>