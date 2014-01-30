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
	background-image: url(res/images/background2.png);
	background-repeat: repeat-y;
	background-attachment: fixed;
	background-position: top;
	background-color: #000;
	font-family: Tahoma, Geneva, sans-serif;
}
/*.newEvent {
	border:5px solid black;
	background-color:#099;
	color:#CCC;
	font-family:"Lucida Console", Monaco, monospace;
	padding:5px;
}
td {
	vertical-align:top;
}
*/
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
#newEventFormContainer{
	position:fixed;
	background-image:url(res/images/win1.png);
	width:548px;
	height:379px;
}
#newEventForm{
	padding-left:180px;
	padding-top:70px;
	color:#096;
}
#listContainer{
	position:absolute;
	left:600px;
}
.listItem{
	background-color:#0CC;
	width:500px;
	height:150px;
	margin-bottom:10px;
	overflow:scroll;
}
.leftBuffer{
	background-color:#099;
	width:10px;
	height:150px;
	float:left;
}
.rightBuffer{
	background-color:#0FF;
	width:10px;
	height:150px;
	float:right;
}
.listImage{
	height:140px;
	float:left;
	margin:5px;
}
.listText{
	height:inherit;
	width:330px;
	float:left;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
function callback(Input,default_value){
   return function() {
      if(Input.val() == default_value) Input.val("");
   }
}
function callback2(Input,default_value){
   return function(){
      if(Input.val().length == 0) Input.val(default_value);
   }
}
var excalibur = false;
function validPassword(pass){
	$.post("security.php",{password:pass},function(data){
		if(data=="true"){
			alert("U GREAT SMART THINK.");
			excalibur = true;
		}else{
			alert("Y U SO BAD AT THIS?");
			excalibur = false;
		}
	});
	alert("DON'T LOOK AT ME.  THE PASSWERD IS "+pass+". EXCALIBUR IS "+excalibur);
	return excalibur;
}
$(document).ready(function(){
  // require password before submit
  $("form").submit(function(event){
	if(event.target.id=="password"||event.target.id=="passwordFormWrapper"){
	   if(validPassword($("#password").val())){
		  alert("VER NICE PERSWERD MUCH APPLAUD");
		  $("#password").hide(1);
	      $("#footer_text").css({ "color": "#0f0"});
	      $("#footer_text").text("Valid password.");
		  $("#newEventPass").val($("#password").val());
	   }else{
		  alert("THIS IS ONLY THE FIRST SCREW UP");
	      $("#footer_text").css({ "color": "#f00"});
	      $("#footer_text").text("Invalid password.");
	   }
	   event.preventDefault();
	} 
	if(!(validPassword($("#password").val()))){
	  event.preventDefault();
	  alert("NOW U IN DEEP PIGEON DOODOO");
	  $("#footer_text").css({ "color": "#f00"});
	  $("#footer_text").text("Invalid password.");
	  $("#password").show().focus();
	}
  });
  
  // clear forms on focus
  for(i = 1; i < 8; i++){
	  var Input = $('input[name=line_0'+i+']');
	  var default_value = Input.val();
	  
	  Input.focus(callback(Input,default_value)).blur(callback2(Input,default_value));
  }

  // Validate password
  $("#password").blur(function(){$(this).submit()});
});
</script>
</head>

<body>
<div id="newEventFormContainer">
	<div id="newEventForm">
    
<form id="addEventForm" action="upload_file.php" method="post"
enctype="multipart/form-data">
<input type="hidden" id="newEventPass" name="password"/>
    	<table id="form" align="center" class="newEvent">
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
    </div>
</div>
<div id="listContainer">
    <?php
		dbconnect();
		
		$query = mysql_query("SELECT * FROM Events ORDER BY id") or die(mysql_error());
		for($i = 0;$row = mysql_fetch_assoc($query);$i++) {
			echo "<div class='listItem'>
					  <div class='leftBuffer'>
					  </div>
					  <img class='listImage' src='".$row['image_url']."' />
					  <div class='listText'>
						".$row['presenting_group']."</br>
						".$row['event_name']."</br>
						".$row['day']."</br>
						".$row['time']."</br>
						".$row['general_price']."</br>
						".$row['special_price']."</br>
						".$row['note']."</br>
						<!--<form action='deleteEvent.php' method='post'><input type='hidden' name='id' value='".$row['id']."'><input type='hidden' name='password' id='".$row['id']."'><input type='submit' onclick='tryDelete(".$row['id'].")' value='delete' /></form>-->
						</div>
						<div class='rightBuffer'>
						</div>
					</div>";
		}
	?>
   </div>
<div id="footer">
<div id="footer_form">
<form id="passwordFormWrapper">
	<input type="password" onsubmit="return false;" id="password"/>
</form>
</div>
<div id="footer_text">
Enter the password to submit a form.
</div>
</div>
</body>
</html>