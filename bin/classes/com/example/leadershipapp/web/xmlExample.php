<?php
include 'security.php';
dbconnect();
$query = mysql_query("SELECT * FROM Events ORDER BY id") or die(mysql_error());
for($i = 0;$row = mysql_fetch_assoc($query);$i++) {
	echo $row['image_url']."
	".$row['presenting_group']."
	".$row['event_name']."
	".$row['day']."
	".$row['time']."
	".$row['general_price']."
	".$row['special_price']."
	".$row['note']."
	BREAK
	";
}
?>