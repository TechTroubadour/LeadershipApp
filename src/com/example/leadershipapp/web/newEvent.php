<?php
	include 'security.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Create New Event</title>
<style type="text/css">
body {
	background-image: url(res/images/hand.png);
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-position: top;
	background-color: #000;
	font-family: Tahoma, Geneva, sans-serif;
}
.newEvent {
	background-color: #399;
}
td {
	vertical-align:top;
}
</style>
</head>

<body>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
  <table align="center">
  <tr>
    <td><table id="form" align="center" class="newEvent" border="1px solid blue">
        <tr>
          <td><label for="file">Image:</label></td>
          <td><input type="file" name="file" id="file"></td>
        </tr>
        <tr>
          <td><label for="line_01">Presenting Group:</label></td>
          <td><input type="text" name="line_01" id="line_01" placeholder="Somebody presents..." /></td>
        </tr>
        <tr>
          <td><label for="line_02">Event Name:</label></td>
          <td><input type="text" name="line_02" id="line_02" placeholder="The Title of the Event" /></td>
        </tr>
        <tr>
          <td><label for="line_03">Day:</label></td>
          <td><input type="text" name="line_03" id="line_03" placeholder="On this day" /></td>
        </tr>
        <tr>
          <td><label for="line_04">Time:</label></td>
          <td><input type="text" name="line_04" id="line_04" placeholder="at this time" /></td>
        </tr>
        <tr>
          <td><label for="line_05">General Price:</label></td>
          <td><input type="text" name="line_05" id="line_05" placeholder="at this price" /></td>
        </tr>
        <tr>
          <td><label for="line_06">Special Price:</label></td>
          <td><input type="text" name="line_06" id="line_06" placeholder="or this price" /></td>
        </tr>
        <tr>
          <td><label for="line_07">Note:</label></td>
          <td><input type="text" name="line_07" id="line_07" placeholder="and a special note" /></td>
        </tr>
        <tr>
          <td><label for="password">Password:</label></td>
          <td><input type="text" name="password" id="password" placeholder="a small security measure" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="submit" value="Submit"></td>
        </tr>
            <?php
				if($_GET['error']){
					echo '<tr><td colspan="3" align="center"><font color="#FF0000">';
					echo $_GET['error'];
					echo '</font></td></tr>';
				}
				
				if($_GET['success']){
					echo '<tr><td colspan="3" align="center"><font color="#00FF00">';
					echo $_GET['success'];
					echo '</font></td></tr>';
				}
			?>
      </table>
</form>
</td>
<td><table align="center" class="newEvent" border="1px solid blue">
    <?php
		dbconnect();
		
		$query = mysql_query("SELECT * FROM Events ORDER BY id") or die(mysql_error());
		for($i = 0;$row = mysql_fetch_assoc($query);$i++) {
			echo "<tr>
					<td><img src='".$row['image_url']."' /></td>
					<td><table>
						<tr>
							<td>".$row['presenting_group']."</td>
						</tr>
						<tr>
							<td>".$row['event_name']."</td>
						</tr>
						<tr>
							<td>".$row['day']."</td>
						</tr>
						<tr>
							<td>".$row['time']."</td>
						</tr>
						<tr>
							<td>".$row['general_price']."</td>
						</tr>
						<tr>
							<td>".$row['special_price']."</td>
						</tr>
						<tr>
							<td>".$row['note']."</td>
						</tr>
					</table></td>
					<td><form action='deleteEvent.php' method='post'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' value='delete' /></form></td>
				</tr>";
		}
	?>
  </table></td>
</tr>
</table>
</body>
</html>