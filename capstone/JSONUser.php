<?php
$person = array();
$count = 0;
	$conn = mysql_connect("localhost","root","") or die("cannot connect");
	mysql_select_db("onlinemarketplace") or die("invalid db");
	$sql = "SELECT * from user where deleted != '1'";
	$result = mysql_query($sql) or die('Unable to run query:'.mysql_error());
	$count = 0;
	if(mysql_num_rows($result)){
		while($row = mysql_fetch_assoc($result)){
			$person[$count] = array('_username' => $row['_username'],'_password' => $row['_password'],'fname' => $row['fname'],'lname' => $row['lname'],'_status' => $row['_status'],'_contact_no' => $row['_contact_no']);
			$count++;
		}
	}
	echo json_encode($person);
?>