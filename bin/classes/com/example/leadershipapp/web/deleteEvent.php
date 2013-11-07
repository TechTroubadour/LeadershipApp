<?php
function dbconnect() {
	$dbhost = 'leadershipAppDat.db.10164554.hostedresource.com';
	$dbname = 'leadershipAppDat';
	$dbuser = 'leadershipAppDat';
	$dbpass = 'N!SFlG9f97ab98';
	mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to database");
	mysql_select_db($dbname);
}
dbconnect();
$id = mysql_real_escape_string($_POST['id']);
$query = "SELECT image_url FROM Events WHERE id = '$id'";
$result = mysql_fetch_assoc(mysql_query($query));
$url = $result['image_url'];
$query = "DELETE FROM Events WHERE id = '$id' LIMIT 1";
$result = mysql_query($query) or die(mysql_error());
unlink($url) or die("Unlink Error");
header("Location: newEvent.php");
?>