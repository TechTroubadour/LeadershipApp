<?php
	include 'security.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Event</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  
});
</script>
</head>

<body>

<?php
	dbconnect();
	
	$query = mysql_query("SELECT * FROM Events ORDER BY id") or die(mysql_error());
	$row;
	do{
		$row = mysql_fetch_assoc($query);
	}while($row['id']!=17);
?>
<img name="image_url" src="<?= $row['image_url'] ?>" /><br />
<form method="post"	action="updateEvent.php">
    <input name="presenting_group" type="text" value="<?= $row['presenting_group'] ?>" /><br />
    <input name="event_name" type="text" value="<?= $row['event_name'] ?>" /><br />
    <input name="day" type="text" value="<?= $row['day'] ?>" /><br />
    <input name="time" type="text" value="<?= $row['time'] ?>" /><br />
    <input name="general_price" type="text" value="<?= $row['general_price'] ?>" /><br />
    <input name="special_price" type="text" value="<?= $row['special_price'] ?>" /><br />
    <input name="note" type="text" value="<?= $row['note'] ?>" /><br />
    <input name="id" type="hidden" value="<?= $row['id'] ?>" /><br />
    <input type="submit" value="Update" />
</form>
</body>
</html>