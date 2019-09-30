<?php
	$username = $_POST['username'];
	$password = $_POST['password1'];
	$conn = mysql_connect('localhost', 'root', '');
	mysql_select_db('onlinemarketplace');
	$sql = "INSERT INTO admin (id,username,password) VALUES('','{$username}','{$password}')";
	mysql_query($sql);
	mysql_close($conn);
	header("Location: member.php");
?>