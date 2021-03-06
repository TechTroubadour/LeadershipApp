<?php
	include 'security.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Create New Event</title>
<link rel="stylesheet" type="text/css" href="style.css">
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
function validPassword(pass){  //Ajax could be changing the order the lines execute.
	$.post("security.php",{password:pass,echo:'true'},function(data){
		if(data=="true"){
			//alert("U GREAT SMART THINK.");
			excalibur = true;
		}else{
			//alert("Y U SO BAD AT THIS?");
			excalibur = false;
		}
	});
	//alert("DON'T LOOK AT ME.  THE PASSWERD IS "+pass+". EXCALIBUR IS "+excalibur);
	return excalibur;
}
$(document).ready(function(){
  // require password before submit
  $("form").submit(function(event){
	//alert(excalibur);
	if(event.target.id=="passwordFormWrapper"){
	   if(validPassword($("#password").val())){
		  //alert("VER NICE PERSWERD MUCH APPLAUD #hipster");
		  $("#footer_form").hide(1);
	      $("#footer_text").css({ "color": "#0f0"});
	      $("#footer_text").text("Valid password.");
		  $("#newEventPass").val($("#password").val());
	   }else{
		  //alert("THIS IS ONLY THE FIRST SCREW UP");
	      $("#footer_text").css({ "color": "#f00"});
	      $("#footer_text").text("Invalid password.");
	   }
	   event.preventDefault();  //The purpose of this might be to temporarily stop form submission
	}else if(event.target.id!="password"&&!(validPassword($("#password").val()))){
	  event.preventDefault();
	  //alert("NOW U IN DEEP PIGEON DOODOO");
	  $("#footer_text").css({ "color": "#f00"});
	  $("#footer_text").text("Invalid password.");
	  $("#password").show().focus();
	}
  });
  
  $(".listItem").mouseenter(function(e) {
     $(this).css({"background-color":"#099"});  
  }).mouseleave(function(e){
     $(this).css({"background-color":"#0CC"});  
  });
  
  // clear forms on focus
  for(i = 1; i < 8; i++){
	  var Input = $('input[name=line_0'+i+']');
	  var default_value = Input.val();
	  
	  Input.focus(callback(Input,default_value)).blur(callback2(Input,default_value));
  }

  // Validate password
  $("#password").blur(function(){$(this).submit()});
  
  // Delete Event
  $(".icon").click(function(e) {
	   if(validPassword($("#password").val())){
		   alert("Event deleted.\nThis cannot be undone.");
			$.post("deleteEvent.php",{password:$("#password").val(),id:$(this).attr("id")},function(data){});
	   }else{
		  e.preventDefault();
	      $("#footer_text").css({ "color": "#f00"});
	      $("#footer_text").text("Invalid password.");
	      $("#password").show().focus();
	   }
  });
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
          <td><input type="text" name="line_03" id="line_03" value="January 1, 2014" /></td>
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
						</div>
						<div class='rightBuffer'>
						</div>
						<a href=''>
							<img class='icon' id='".$row['id']."' src='res/images/b_drop.png' />
						</a>
					</div>";
		}
	?>
<br />
<br />
<br />
<br />
<br />
</div>
<div id="footer">
<div id="footer_form">
<form id="passwordFormWrapper">
	<input type="password" onsubmit="return false;" id="password"/>
    <input type="submit" value="Authorize" />
</form>
</div>
<div id="footer_text">
Enter the password to submit a form.<br />You may have to submit the password twice...
</div>
</div>
</body>
</html>