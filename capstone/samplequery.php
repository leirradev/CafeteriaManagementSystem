<table id="tablecategory" style="position:relative;top:10;width:400;left:250;">
					<tr>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CATEGORY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							MANAGE
						</td>
					</tr>
<?php
require('include/connection.php');
$total = 0;
$sql = "SELECT * from category";
$res=mysql_query($sql) or die ("db query failed" .mysql_error());
while($fet=mysql_fetch_array($res)){
	$sample = $fet['categoryname'];
	$sample2 = $fet['id'];
	$newlist[] = $sample;
	$newlist1[] = $sample2;
}
//print_r($newlist);
foreach($newlist as $data){
$total = 0;
//$index = 0;
$sql2 = "SELECT * from product where category = '$data'";
$res1=mysql_query($sql2) or die ("db query failed" .mysql_error());
while($fet1=mysql_fetch_array($res1)){
	$sample = $fet1['category'];
	$total = $total + count($sample);
	$prodid[] = $fet1['id'];
	//echo $sample;
}
//$index++;
//"</br>";
//echo $total;
//echo $newlist[3];
if($total == 0){
	echo "<tr>";
		echo "<td>";
			echo $data;
		echo "</td>";
		echo "<td>";
		//dito lalagay ung href
			echo "<a href='productcategory.php?categoryname={$data}'><img src='images/Editing-Delete-icon.png' style='width:30px' title='DELETE'/></a></br>";
		echo "</td>";
	echo "</tr>";
	//$index++;
}
else{
	echo "<tr>";
		echo "<td>";
		echo $data;
		echo "</td>";
		echo "<td>";
		//echo "<a href='productcategory.php?categoryname={$data}'><img src='images/Editing-Delete-icon.png' style='width:30px;' title='DELETE'/></a></br>";
		echo "</td>";
	echo "</tr>";
}    
}
?>