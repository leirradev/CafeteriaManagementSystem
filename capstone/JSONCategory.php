<?php

mysql_connect("localhost","root","");
mysql_select_db("onlinemarketplace");
$sql=mysql_query("select * from category");

$i=0;

while($row=mysql_fetch_assoc($sql))
{   




//Where Image Exists.
//First taking path from database and then image from folder against that path and then //converting it ino base64 and then Json
    $output [$i] ['category'] = $row['category'];
	


  $i++;
}
echo json_encode($output);






mysql_close();
?>