<?php
$adminusername = $_GET['adminusername'];
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('onlinemarketplace');

$sql = "SELECT * FROM admin
		WHERE
		username = '{$adminusername}'";

$results = mysql_query($sql);
$count = mysql_num_rows($results);

	if($count==1){
		//echo "{$category} is not available.";
		echo "0";
	}
	
	else{
		//echo "{$category} is available.";
		echo "1";
	}

?>