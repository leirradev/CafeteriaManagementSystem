<?php
	$username = $_POST['username'];
	$password = $_POST['password1'];
	$studcontact = $_POST['contacts'];
	$parentscontact = $_POST['pcontacts'];
	$load = $_POST['load'];
	$conn = mysql_connect('localhost', 'root', '');
	mysql_select_db('onlinemarketplace');
	$sql = "INSERT INTO user (_id,_username,_password,_contact_no,_contact_no_of_guardian,_load,_status,deleted) VALUES('','{$username}','{$password}','{$studcontact}','{$parentscontact}','{$load}','ACTIVE','0')";
	mysql_query($sql);
	mysql_close($conn);
	header('Location: sendsms.php?user='.$username.'&pass='.$password.'&pnum='.$studcontact);
?>