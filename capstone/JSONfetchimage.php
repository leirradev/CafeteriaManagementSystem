<?php

mysql_connect("localhost","root","");
mysql_select_db("onlinemarketplace");
$sql=mysql_query("select * from product where deleted = 0 and status = 'AVAILABLE' order by name");

$i=0;

while($row=mysql_fetch_assoc($sql))
{   




//Where Image Exists.
//First taking path from database and then image from folder against that path and then //converting it ino base64 and then Json
    $output [$i]['images']= "http://192.168.1.172/capstone/images/products/".$row['images'];
	$output [$i] ['name'] = $row['name'];
	$output [$i] ['price'] = $row['price'];
	$output [$i] ['category'] = $row['category'];
	$output [$i] ['description'] = $row['description'];
	$output [$i] ['id'] = $row['id'];


  $i++;
}
echo json_encode($output);






mysql_close();
?>