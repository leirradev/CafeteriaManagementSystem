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
	$sql = "SELECT * FROM user
		WHERE
		_username LIKE '%{$name}%' order by _username";
}
else if($cate == "lname"){
	$sql = "SELECT * FROM user
		WHERE
		lname LIKE '%{$name}%' order by _username";
}
else if($cate == "fname"){
	$sql = "SELECT * FROM user
		WHERE
		fname LIKE '%{$name}%' order by _username";
}
else if($cate == "status"){
	$sql = "SELECT * FROM user
		WHERE
		_status LIKE '%{$name}%' order by _username";
}
$results = mysql_query($sql);
?>
<table id="catalogTable">
	<tr style="background-color:black;color:white;text-align:center;font-family:Segoe UI;font-size:12px;">
		<td>
			USERNAME
		</td>
		<td>
			LAST NAME
		</td>
		<td>
			FIRST NAME
		</td>
		<td>
			CONTACT NUMBER
		</td>
		<td>
			PARENTS CONTACT NUMBER
		</td>
		<td>
			LOAD
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
		$id			= $result['_id'];
		$name 		= $result['_username'];
		$desc 		= $result['_password'];
		$lname      = $result['lname'];
		$fname      = $result['fname'];
		$cate	 	= $result['_contact_no'];
		$pric		= $result['_contact_no_of_guardian'];
		$load       = $result['_load'];
		$status     = $result['_status'];
		$deleted     = $result['deleted'];
?>
	<tr>
		<td>
			<?php echo "{$name}"; ?>
		</td>
		<td>
			<?php echo "{$lname}"; ?>
		</td>
		<td>
			<?php echo "{$fname}"; ?>
		</td>
		<td>
			<?php echo "{$cate}"; ?>
		</td>
		<td>
			<?php echo "{$pric}"; ?>
		</td>
		<td>
			<?php echo "{$load}"; ?>
		</td>
		<td>
			<?php echo "{$status}"; ?>
		</td>
		<td>
			<a class="links" href="manageuserstatus.php?user_id=<?php echo"{$id}";?>&status=<?php echo"{$status}";?>&deleted=<?php echo"{$deleted}";?>"><img title="CHANGE STATUS" src="editstatus.png" style="width:20px"></a><a class="links" href="edituser.php?user_id=<?php echo"{$id}";?>"><img title="EDIT" src="images/editedit.png" style="width:20px"></a><a class="links" href="deleteuser.php?user_id=<?php echo"{$id}";?>"><img title="DELETE" src="images/deletedelete.png" style="width:20px"></a>
			
		</td>
	</tr>
<?php		
	}
?>
</table>