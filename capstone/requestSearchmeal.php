<?php 
//request from server
//main div class=show
//img style="width:80px;float:left; margin-right:10px;
//span class name
// span class votes

$name = $_GET['name'];
$cate = $_GET['category'];
//$total = 0;
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('onlinemarketplace');


if($cate == "name")
{
	$sql = "SELECT * FROM product
		WHERE
		name LIKE '%{$name}%' and deleted = 0 order by name";
}
else if($cate == "category"){
	$sql = "SELECT * FROM product
		WHERE
		category LIKE '%{$name}%' and deleted = 0 order by name";
}else if($cate == "status"){
	$sql = "SELECT * FROM product
		WHERE
		status LIKE '%{$name}%' and deleted = 0 order by name";
}
$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							NAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CATEGORY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PRICE
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
	</tr>

<?php
	
	while($result = mysql_fetch_array($results)){
		$id			= $result['id'];
		$imag       = $result['images'];
		$name1 		= $result['name'];
		$desc 		= $result['description'];
		$cate	 	= $result['category'];
		$pric		= $result['price'];
		$status     = $result['status'];
		$deleted    = $result['deleted'];
?>
	<tr>
		<td>
			<?php echo "{$name1}"; ?>
		</td>
		<td>
			<?php echo "{$cate}"; ?>
		</td>
		<td>
			<?php echo "{$pric}"; ?>
		</td>
		<td>
			<?php echo "{$status}"; ?>
		</td>
	</tr>
<?php		
	}
	
	if($_GET['category'] == "name"){
	?>
	<tr><td colspan="4" align="center"><?php echo "<a href=mealreport1.php?name=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
	else if($_GET['category'] == "category"){
	?>
	<tr><td colspan="4" align="center"><?php echo "<a href=mealreport2.php?category=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
	else if($_GET['category'] == "status"){
	?>
	<tr><td colspan="4" align="center"><?php echo "<a href=mealreport3.php?status=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
?>
</table>