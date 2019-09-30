<?php
$date = date("m/d/Y");
?>
<?php 
//request from server
//main div class=show
//img style="width:80px;float:left; margin-right:10px;
//span class name
// span class votes

$name = $_GET['name'];
$cate = $_GET['category'];
$total = 0;
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('onlinemarketplace');


if($cate == "name")
{
	$sql = "SELECT * FROM transaction
		WHERE
		id LIKE '%{$name}%' and status = 'PENDING' and date = '{$date}'";
}
else{
	$sql = "SELECT * FROM transaction
		WHERE
		user LIKE '%{$name}%' and status = 'PENDING' and date = '{$date}' order by id desc";
}

$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr>
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
						    AMOUNT
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    TIME ORDERED
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    DATE
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    MANAGE
						</td>
	</tr>

<?php
	
	while($result = mysql_fetch_array($results)){
		$id			= $result['id'];
		$name1 		= $result['user'];
		$prod 		= $result['product'];
		$quant	 	= $result['quantity'];
		$pric		= $result['amount'];
		$status     = $result['status'];
		$torder     = $result['timeOrder'];
		$tclaim     = $result['timeClaim'];
		$date 		= $result['date'];
		
		$newprod = explode(",",$prod);
		$newqty = explode(",",$quant);
		$newpric = explode(",",$pric);
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
				foreach($newpric as $data2){
					echo "{$data2}"."</br>";
				}
			?>
		</td>
		<td>
			<?php echo "{$status}"; ?>
		</td>
		<td>
			<?php echo "{$torder}"; ?>
		</td>
		<td>
			<?php echo "{$date}"; ?>
		</td>
		<td>
			<a href='claimproduct.php?transaction_id=<?php echo "{$id}"; ?>'>
			<button type='button' class='btn btn-success'>Done</button>
			</a>
		</td>
	</tr>
<?php		
	}
?>
</table>