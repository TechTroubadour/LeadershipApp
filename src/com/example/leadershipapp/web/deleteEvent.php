<?php
include 'security.php';
dbconnect();
$id = mysql_real_escape_string($_POST['id']);
$pass = mysql_real_escape_string($_POST['pass']);
$query = "SELECT image_url FROM Events WHERE id = '$id'";
$result = mysql_fetch_assoc(mysql_query($query));
$url = $result['image_url'];
$query = "DELETE FROM Events WHERE id = '$id' LIMIT 1";
$result = mysql_query($query) or die(mysql_error());
unlink($url) or die("Unlink Error");
?>