<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<title>Admin Portal</title>
<?php
	session_start();
	require_once("include/connection.php");	
	if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {

header ("Location: adminlogin.php");

}	
?>
<?php
	if(isset($_GET['memberid']))
	{
		$get_category = $_GET['memberid'];
		$sql = "DELETE FROM admin WHERE id= {$get_category}";
		mysql_query($sql);
		header("Location:member.php");
	}
	else
	{
		$get_category=NULL;
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css"> 
		<link rel="stylesheet" type="text/css" href="css/member.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/member.js"></script>
		<script type="text/javascript" src="js/checkadmin.js"></script>
		<script>
			function validatefrm(){
				var pass1 = document.getElementById('password1').value;
				var pass2 = document.getElementById('password2').value;
				if(pass1 == pass2)
				{
					
				}
				else
				{	
					document.getElementById('invalidpassword1').innerHTML = "Password did not match.";
					document.getElementById('invalidpassword2').innerHTML = "Password did not match.";
					return false;
				}
			}
		</script>
	</head>
	<body onload="startTime()">
		<div id="header">
			<img src="titoli.png" style="width:170px;left:100px;top:20px;position:relative;"/>
				
			<div id="time">
			</div>
			<div id="day">
			</div>
			<div id="date">
			</div>
		</div>
		<div id="setting">
				<ul id="jsddm">
					<li><a href="admin.php">HOME</a></li>
					<li><a href="productadd.php">PRODUCTS</a></li>
					<li><a href="member.php">ADMIN</a></li>
					<li><a href="user.php">MEMBER</a></li>
					<li><a href="reports.php">REPORTS</a></li>
					<li><a href="transaction.php">TRANSACTION</a></li>
				</ul>
				<a href="logout.php">
					<img src="images/logout.png" style="left:-150px;position:relative;width:30px;top:5px;" title="logout"/>
				</a>
				<div style="left:-200px;position:relative;width:25px;top:-20px;color:white;"><?php echo"{$_SESSION['username']}"; ?></div>
		</div>
		<div id="homecontainer" style="position:relative;top:-25px;">
		<div id="membercontainer" style="top:10px;position:relative;">
			<div id="productcontainerlinks">
				<a href="member.php">
					<div id="btnadd">
						<img src="images/administrator.png" class="icons" style="width:20px;height:20px;">ADMIN
					</div>
				</a>
			</div>
			
			<div id="addcontent" style="width:900px;margin-top:0%;left:0px;">
				<span id="addtitle">ADMIN</span>
				<div id="addadmin" style="margin-top:4%;">
					ADD ADMIN
				</div>
				<table id="tablecategory">
					<tr>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							ID
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
							ADMIN
						</td>
						<td style="background-color:black;color:white;padding: 5 5 5 5">
						</td>
					</tr>
					<?php
						$sql="SELECT * FROM admin";
						$res=mysql_query($sql) or die ("db query failed" .mysql_error());
						while($fet=mysql_fetch_array($res)){
							echo "<tr>";
								echo "<td>";
									echo "{$fet['id']}";
								echo "</td>";
								echo "<td>";
									echo "{$fet['username']}";
								echo "</td>";
								echo "<td>";
									echo "<a href='member.php?memberid={$fet['id']}'><img src='images/Editing-Delete-icon.png' style='width:30px' title='DELETE'/></a>";
								echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
				
				<div id="addform">
					<div id="closefrm">
						<img src="images/close_icon.png" style="width:40px;"/>
					</div>
					<form onsubmit="return validatefrm()" action="addadmin.php" method="post">
					<span id="addtitle2">ADD ADMIN</span>
					<hr>
						<table style="position:absolute;top:50;width:100%;">
							<tr>
								<td><label class="labels" for="username">Username:</label></td>
								<td id="invalidusername"></td>
							</tr>
							<tr>
								<td colspan="2"><input onchange="buildAjaxNow(this.value)" onblur="setBlur(this)" required="required" type="text" name="username" id="username" style="width:90%;" /></td>
							</tr>
							<tr>
								<td><label class="labels" for="password">Password:</label></td>
								<td id="invalidpassword1" style="font-size:12px;"></td>
							</tr>
							<tr>
								<td colspan="2"><input class="input2" required="required" type="password" name="password1" id="password1" style="width:90%;" /></td>
							</tr>
							
							<tr>
								<td><label class="labels" for="password">Confirm Password:</label></td>
								<td id="invalidpassword2" style="font-size:12px;"></td>
							</tr>
							<tr>
								<td colspan="2"><input class="input2" required="required" type="password" name="password2" id="password2" style="width:90%;" /></td>
							</tr>
							<tr>
								<td colspan="2">
									<input id="addbtn" type="submit" name="addbtn" value="ADD ADMIN"  />
								</td>
								
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		</div>
	</body>
	<script>
		$("#addadmin").click(function() {
			$("#addform").animate({left: 500});
		});
		$("#closefrm").click(function() {
			$("#addform").animate({left: 2000});
		});
	</script>
</html>