<?php 
//request from server
//main div class=show
//img style="width:80px;float:left; margin-right:10px;
//span class name
// span class votes

$name = $_GET['name'];
$cate = $_GET['category'];
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
}
else{
	$sql = "SELECT * FROM product
		WHERE
		status LIKE '%{$name}%' and deleted = 0 order by name";
}
$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
		<td>
			IMAGE
		</td>
		<td>
			NAME
		</td>
		<td>
			DESCRIPTION
		</td>
		<td>
			CATEGORY
		</td>
		<td>
			PRICE
		</td>
		<td>
			STATUS
		</td>
		<td>
			MANAGE
		</td>
	</tr>

<?php
	
	while($result = mysql_fetch_array($results)){
		$id			= $result['id'];
		$imag       = $result['images'];
		$name 		= $result['name'];
		$desc 		= $result['description'];
		$cate	 	= $result['category'];
		$pric		= $result['price'];
		$status     = $result['status'];
		$deleted    = $result['deleted'];
?>
	<tr style="text-align:center;font-family:Segoe UI;font-size:12px;">
		<td>
			<img src='images/products/<?php echo "{$imag}";?>' style='width:100px;height:100px;'>
		</td>
		<td>
			<?php echo "{$name}"; ?>
		</td>
		<td>
			<?php echo "{$desc}"; ?>
		</td>
		<td>
			<?php echo "{$cate}"; ?>
		</td>
		<td>
			<?php echo "Php ".$pric.".00"; ?>
		</td>
		<td>
			<?php echo "{$status}"; ?>
		</td>
		<td>
			<a class="links" href="manageproductstatus.php?product_id=<?php echo"{$id}";?>&status=<?php echo "{$status}"; ?>&deleted=<?php echo "{$deleted}"; ?>"><img title="CHANGE STATUS" src="editstatus.png" style="width:20px"></a><a class="links" href="productedit.php?product_id=<?php echo"{$id}";?>"><img title="EDIT PRODUCT" src="images/editedit.png" style="width:20px"></a><a class="links" href="productedit.php?prod_id=<?php echo"{$id}";?>"><img title="DELETE PRODUCT" src="images/deletedelete.png" style="width:20px"></a>
		</td>
	</tr>
<?php		
	}
?>
</table>