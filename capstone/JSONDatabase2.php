<?php
$person = array();
$count=0;
	$conn  = mysql_connect("localhost", "root", "")or die("cannot connect");
	mysql_select_db("onlinemarketplace") or die();
	$sql = "SELECT * from product where deleted = 0 and status = 'AVAILABLE' order by name";
	$result = mysql_query($sql) or die('Unable to run query:'.mysql_error());
	$count=0;
	if(mysql_num_rows($result)){
		while ($row = mysql_fetch_assoc($result)) {
				$person[$count] = array('id' => $row['id'],'images' => $row['images'],'name'=>$row['name'],'description' => $row['description'],
				'category' => $row['category'], 'price' => $row['price'], 'uploadedby' => $row['uploadedby'], 'deleted' => $row['deleted']); 
				$count++;
		}
	}
	echo json_encode($person);
?>