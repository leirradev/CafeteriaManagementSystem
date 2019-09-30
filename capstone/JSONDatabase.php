<?php
$person = array();
$count=0;
	$conn  = mysql_connect("localhost", "root", "")or die("cannot connect");
	mysql_select_db("onlinemarketplace") or die();
	$sql = "SELECT * from user";
	$result = mysql_query($sql) or die('Unable to run query:'.mysql_error());
	$count=0;
	if(mysql_num_rows($result)){
		while ($row = mysql_fetch_assoc($result)) {
				$person[$count] = array('_id' => $row['_id'],'_username' => $row['_username'],'_password'=>$row['_password'],'_contact_no' => $row['_contact_no'], '_contact_no_of_guardian' => $row['_contact_no_of_guardian']); 
				$count++;
		}
	}
	echo json_encode($person);
?>