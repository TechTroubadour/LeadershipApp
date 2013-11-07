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
	background-image: url(res/images/background.png);
	background-repeat: repeat-y;
	background-attachment: fixed;
	background-position: top;
	background-color: #000;
	font-family: Tahoma, Geneva, sans-serif;
}
.newEvent {
	border:5px solid black;
	background-color:#099;
	color:#CCC;
	font-family:"Lucida Console", Monaco, monospace;
	padding:5px;
}
td {
	vertical-align:top;
}
#footer {
	width:500px;
	position:fixed;
	bottom:0px;
	left:50%;
	margin-left:-250px;
	background-color:#099;
	border:5px solid black;
	color:#CCC;
	font-family:"Lucida Console", Monaco, monospace;
	padding:10px;
	text-align:center;
}
#footer_form{
	padding:5px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	
  // require password before submit
  $("form").submit(function(event){
	if(event.target.id=="password"){
	   if($("#password").text()=="samplePassword"){
	      $("#footer_text").css({ "color": "#0f0"})
	      $("#footer_text").text("Valid password.")
	   }else{
	      $("#footer_text").css({ "color": "#f00"})
	      $("#footer_text").text("Valid password.")
	   }
	   return;
	}
	event.preventDefault();
  });
  // clear forms on focus
  var Input = new Array();
  //var Input = $('input[name=line_01]');
  var default_value = new Array();//Input.val();
  for(var i = 1; i < 8; i++){
	  Input[i] = $('input[name=line_0'+i+']');
	  dfault_value[i] = Input[i].val();
	  Input[i].focus(function() {
		if(Input.val() == default_value) Input.val("");
	  }).blur(function(){
		if(Input.val().length == 0) Input.val(default_value);
	  });
  }

  
  // Validate password
  $("#password").blur(function(){$(this).submit()});
});
</script>
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
          <td><input type="text" name="line_01" id="line_01" value="Somebody presents..." /></td>
        </tr>
        <tr>
          <td><label for="line_02">Event Name:</label></td>
          <td><input type="text" name="line_02" id="line_02" value="The Title of the Event" /></td>
        </tr>
        <tr>
          <td><label for="line_03">Day:</label></td>
          <td><input type="text" name="line_03" id="line_03" value="Januray 1, 2014" /></td>
        </tr>
        <tr>
          <td><label for="line_04">Time:</label></td>
          <td><input type="text" name="line_04" id="line_04" value="12:00am" /></td>
        </tr>
        <tr>
          <td><label for="line_05">General Price:</label></td>
          <td><input type="text" name="line_05" id="line_05" value="$1 general admission" /></td>
        </tr>
        <tr>
          <td><label for="line_06">Special Price:</label></td>
          <td><input type="text" name="line_06" id="line_06" value="$1 with ASB" /></td>
        </tr>
        <tr>
          <td><label for="line_07">Note:</label></td>
          <td><input type="text" name="line_07" id="line_07" value="Located in the PAC" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="submit" value="Submit"></td>
        </tr>
            <?php
				if($_GET['error']){
					echo '<tr><td colspan="3" id="error" align="center"><font color="#FF0000">';
					echo $_GET['error'];
					echo '</font></td></tr>';
				}
				
				if($_GET['success']){
					echo '<tr><td colspan="3" id="error" align="center"><font color="#00FF00">';
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
					<td><form action='deleteEvent.php' method='post'><input type='hidden' name='id' value='".$row['id']."'><input type='hidden' name='password' id='".$row['id']."'><input type='submit' onclick='tryDelete(".$row['id'].")' value='delete' /></form></td>
				</tr>";
		}
	?>
  </table></td>
</tr>
</table>
<div id="footer">
<div id="footer_form">
	<input type="password" id="password"/>
</div>
<div id="footer_text">
Enter the password to submit a form.
</div>
</div>
</body>
</html>