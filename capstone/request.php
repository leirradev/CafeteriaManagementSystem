<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<?php
	require_once("include/connection.php");	
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/admin.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/request.js"></script>
	</head>
	<body onload="startTime(),ini()">
		<div id="navigation">
			<img src="images/logo.png" id="logo"/>
			<div id="linkscontainer">
				<a href="admin.php"><span id="links1"><img src="images/homeicon.png" class="icons"> HOME</span></a>
				<a href="message.php"><span id="links2"><img src="images/messageicon.png" class="icons"> MESSAGES</span></a>
				<a href="request.php"><span id="links4"><img src="images/requesticon.png" class="icons"> REQUESTS</span></a>
				<a href="productadd.php"><span id="links5"><img src="images/producticon.png" class="icons"> PRODUCTS</span></a>
				<a href="member.php"><span id="links6"><img src="images/membericon.png" class="icons"> MEMBERS</span></a>
				<a href="editwebsite.php"><span id="links7"><img src="images/editwebsiteicon.png" class="icons"> EDIT WEBSITE</span></a>
			</div>
		</div>
		<div id="header">
			<div id="time">
			</div>
			<div id="day">
			</div>
			<div id="date">
			</div>
		</div>
		<div id="setting">
		
		</div>
		<div id="requestcontainer">
			
		</div>
	</body>
</html>