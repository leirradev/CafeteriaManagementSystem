<?php
 
define('HOST','localhost');
define('USER','root');
define('DB','onlinemarketplace');

@$con = mysql_connect(HOST,USER,'');
if(!$con)
{
	die("Failed" . mysql_error());
}
@$db = mysql_select_db(DB);
if(!$db)
{
	die("Failed" . mysql_error());
}

?>