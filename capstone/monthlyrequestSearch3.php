<?php 
//request from server
//main div class=show
//img style="width:80px;float:left; margin-right:10px;
//span class name
// span class votes
date_default_timezone_set('Asia/Manila');
$date = date('m');
$name = $_GET['name'];
$cate = $_GET['category'];
$total = 0;
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('onlinemarketplace');
if($cate == "name")
{
	$sql = "SELECT * FROM transaction
		WHERE
		id LIKE '%{$name}%' and status = 'CLAIM' and date LIKE '{$date}%' order by id desc";
}
else if($cate == "category"){
	$sql = "SELECT * FROM transaction
		WHERE
		user LIKE '%{$name}%' and status = 'CLAIM' and date LIKE '{$date}%' order by id desc";
}
else if($cate == "product"){
	$sql = "SELECT * FROM transaction
		WHERE
		product LIKE '%{$name}%' and status = 'CLAIM' and date LIKE '{$date}%' order by id desc";
}
else if($cate == "date"){
	$sql = "SELECT * FROM transaction
		WHERE
		date LIKE '{$name}%' and status = 'CLAIM' order by id desc";
}
$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							TRANSACTION ID
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							USERNAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PRODUCT NAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    QUANTITY
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    SUBTOTAL
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TOTAL
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TIME ORDERED
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TIME CLAIMED
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    DATE PURCHASED
						</td>
	</tr>

<?php
	
	while($result = mysql_fetch_array($results)){
		$id			= $result['id'];
		$name1 		= $result['user'];
		$prod 		= $result['product'];
		$quant	 	= $result['quantity'];
		$pric		= $result['amount'];
		$tot        = $result['total'];
		$stat        = $result['status'];
		$tor        = $result['timeOrder'];
		$toc        = $result['timeClaim'];
		$date 		= $result['date'];
		
		$newprod = explode(",",$prod);
		$newqty = explode(",",$quant);
		$newamt = explode(",",$pric);
?>
	<tr>
		<td>
			<?php echo "{$id}"; ?>
		</td>
		<td>
			<?php echo "{$name1}"; ?>
		</td>
		<td>
			<?php
				foreach($newprod as $data){
					echo "{$data}"."</br>";
				}
			?>
		</td>
		<td>
			<?php
				foreach($newqty as $data1){
					echo "{$data1}"."</br>";
				}
			?>
		</td>
		<td>
			<?php
				foreach($newamt as $data2){
					echo "{$data2}"."</br>";
				}
			?>
		</td>
		<td>
			<?php echo "{$tot}"; ?>
		</td>
		<td>
			<?php echo "{$stat}"; ?>
		</td>
		<td>
			<?php echo "{$tor}"; ?>
		</td>
		<td>
			<?php echo "{$toc}"; ?>
		</td>
		<td>
			<?php echo "{$date}"; ?>
		</td>
		<?php $total = $tot + $total;?>
	</tr>
<?php		
	}
	
	if($cate == "name")
	{
	?><tr><td colspan="10" align="center"><?php echo "Total: Php ".$total.""; ?></td></tr>
	<tr><td colspan="10" align="center"><?php echo "<a href=monthlytransactionreport1.php?total=".$total."&id=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
	else if($cate == "category"){
	?><tr><td colspan="10" align="center"><?php echo "Total: Php ".$total.""; ?></td></tr>
	<tr><td colspan="10" align="center"><?php echo "<a href=monthlytransactionreport2.php?total=".$total."&user=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
	else if($cate == "product"){
	?><tr><td colspan="10" align="center"><?php echo "Total: Php ".$total.""; ?></td></tr>
	<tr><td colspan="10" align="center"><?php echo "<a href=monthlytransactionreport3.php?total=".$total."&product=".$name.">Print</a></td></tr>";?><?php
	}
	else if($cate == "date"){
	?><tr><td colspan="10" align="center"><?php echo "Total: Php ".$total.""; ?></td></tr>
	<tr><td colspan="10" align="center"><?php echo "<a href=monthlytransactionreport4.php?total=".$total."&date=".$name.">Print</a></td></tr>";?><?php
	}
?>
</table>