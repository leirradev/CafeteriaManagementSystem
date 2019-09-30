
<?php
require_once("include/connection.php");
$total = 0;
$sql="SELECT * FROM product WHERE status = 'AVAILABLE'";
$res=mysql_query($sql) or die ("db query failed" .mysql_error());
while($fet=mysql_fetch_array($res)){
			//echo count($fet['id']);
			$total = $total + count($fet['id']);
}
echo $total;
?>