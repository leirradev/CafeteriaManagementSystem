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
	$sql = "SELECT * FROM user
		WHERE
		_username LIKE '%{$name}%' and deleted = 0 order by _username";
}
else if($cate == "status"){
	$sql = "SELECT * FROM user
		WHERE
		_status LIKE '%{$name}%' and deleted = 0 order by _username";
}
$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							USERNAME
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							CONTACT NUMBER
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    PARENTS CONTACT NUMBER
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    LOAD
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						    STATUS
						</td>
	</tr>

<?php
	
	while($result = mysql_fetch_array($results)){
		//$id			= $result['id'];
		//$imag       = $result['images'];
		$name1 		= $result['_username'];
		//$desc 		= $result['description'];
		$cate	 	= $result['_contact_no'];
		$pric		= $result['_contact_no_of_guardian'];
		$status     = $result['_status'];
		$load    = $result['_load'];
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
			<?php echo "Php ".$load.".00"; ?>
		</td>
		<td>
			<?php echo "{$status}"; ?>
		</td>
	</tr>
<?php		
	}
	
	if($_GET['category'] == "name"){
	?>
	<tr><td colspan="5" align="center"><?php echo "<a href=membersreport1.php?name=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
	else if($_GET['category'] == "status"){
	?>
	<tr><td colspan="5" align="center"><?php echo "<a href=membersreport2.php?status=".$name."><button class='form-control'>Print</button></a></td></tr>";?><?php
	}
?>
</table>