<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<html>
<?php
	session_start();
	require_once("include/connection.php");	
?>
<?php
	if(isset($_POST['addBan']))
	{
		$url	=	rand();
		if(empty($_FILES['fileimage']['tmp_name'])){
			mysql_close($con);
			die("ERROR");
		}
		else{
			$file = $_FILES['fileimage']['tmp_name'] or die("MALI1".mysql_error());
			move_uploaded_file($file,"images/banner/{$url}.jpg") or die("MALI3".mysql_error());
			$query2 = mysql_query("INSERT INTO banner VALUES ('','{$url}.jpg')") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:editwebsite.php")or die("MALI".mysql_error());
		}
	}
	if(isset($_POST['changelogo']))
	{
		$url	=	rand();
		if(empty($_FILES['filelogo']['tmp_name'])){
			mysql_close($con);
			die("ERROR");
		}
		else{
			$file = $_FILES['filelogo']['tmp_name'] or die("MALI1".mysql_error());
			move_uploaded_file($file,"images/logo/{$url}.jpg") or die("MALI3".mysql_error());
			$query2 = mysql_query("UPDATE content SET logo = '{$url}.jpg'") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:editwebsite.php")or die("MALI".mysql_error());
		}
	}
	if(isset($_POST['savetitl']))
	{
		$title	=	$_POST['titl'];
		$query2 = mysql_query("UPDATE content SET title = '{$title}'") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:editwebsite.php")or die("MALI".mysql_error());
	}
	if(isset($_POST['savesubt']))
	{
		$subt	=	$_POST['subt'];
		$query2 = mysql_query("UPDATE content SET subtitle = '{$subt}'") or die("MALI4".mysql_error());
			if (!$query2){ // add this check.
				die('Invalid query: ' . mysql_error());
			}
			mysql_close($con);
			header("Location:editwebsite.php")or die("MALI".mysql_error());
	}
	
?>
<?php
	$sql="SELECT * FROM content";
	$res=mysql_query($sql) or die ("db query failed" .mysql_error());
	while($fet=mysql_fetch_array($res)){
		$logo = $fet['logo'];
		$titl = $fet['title'];
		$subt = $fet['subtitle'];
		$bgco = $fet['bgcolor'];
	}
?>
	<head>
        <script type="text/javascript" src="js/js1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/admin.css"> 
		<script type="text/javascript" src="js/time.js"></script>
		<script type="text/javascript" src="js/ediwebsite.js"></script>
	</head>
	<body onload="startTime()">
		<div id="navigation">
			<img src="images/logo/<?php echo"{$logo}"; ?>" id="logo"/>
			<div id="linkscontainer">
				<a href="admin.php"><span id="links1"><img src="images/homeicon.png" class="icons"> HOME</span></a>
				<a href="productadd.php"><span id="links5"><img src="images/producticon.png" class="icons"> PRODUCTS</span></a>
				<a href="member.php"><span id="links6"><img src="images/membericon.png" class="icons"> MEMBERS</span></a>
				<a href="editwebsite.php"><span id="links7"><img src="images/editwebsiteicon.png" class="icons"> EDIT WEBSITE</span></a>
			</div>
		</div>
		<div id="header">
			<div id="time">
			</div>
			<div id="day">
			</div>
			<div id="date">
			</div>
		</div>
		<div id="setting">
			<a href="logout.php" style="text-decoration:none;">
				<img src="images/logout.png" style="width:25px;vertical-align:middle;" title="logout"/>
			</a>
			<?php echo"{$_SESSION['user']}"; ?>
		</div>
		<div id="editwebsitecontainer">
			<table style="margin-top:10;margin-left:10;">
				<tr style="background-color:black;color:white;font-family:Segoe UI;font-size:12px;">
					<td colspan="3">
						LOGO:<span style="color:red;font-size:11px;"> size atleast 100x100px for good quality</span>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<img src="images/logo/<?php echo"{$logo}"; ?>" style="width:100px;height:100px;"/>
					</td>
				</tr>
				<tr>
					<form id="addprod" name="addprod" method="POST" action="" enctype="multipart/form-data">
						<td>
							<input required="required" type="file" id="filelogo" name='filelogo' value="Browse Picture"/>
						</td>
						<td colspan="2">
							<input type="submit" name="changelogo" value="SAVE">
						</td>
					</form>
				</tr>
				<tr style="background-color:black;color:white;font-family:Segoe UI;font-size:12px;">
					<td colspan="3">
							TITLE:
					</td>
				</tr>
				<tr>
					<form id="addprod" name="addprod" method="POST" action="" >
						<td>
							<input type="text" id="titl" name="titl" value="<?php echo"{$titl}"; ?>">
						</td>
						<td colspan="2">
							<input type="submit" name="savetitl" value="SAVE">
						</td>
					</form>
				<tr style="background-color:black;color:white;font-family:Segoe UI;font-size:12px;">
					<td colspan="3">
						SUBTITLE:
					</td>
				</tr>
				<tr>
					<form id="addprod" name="addprod" method="POST" action="" >
						<td>
							<input type="text" id="subt" name="subt" value="<?php echo"{$subt}"; ?>">
						</td>
						<td>
							<input type="submit" name="savesubt" value="SAVE">
						</td>
					</form>
				</tr>
				<tr style="background-color:black;color:white;font-family:Segoe UI;font-size:12px;">
					<td colspan="3">
						BANNER:
					</td>
				</tr>
				<tr style="background-color:black;color:white;font-family:Segoe UI;font-size:12px;">
					<td colspan="3">
						ADD BANNER: <span style="color:red;font-size:11px;"> fit for 1024 x 350px </span>
					</td>
				</tr>
				<tr>
					<form id="addprod" name="addprod" method="POST" action="" enctype="multipart/form-data">
						<td>
							<input required="required" type="file" id="fileimage" name='fileimage' value="Browse Picture"/>
						</td>
						<td colspan="2">
							<input type="submit" name="addBan" value="ADD">
						</td>
					</form>
				</tr>
				<tr>
					<div id="banners">
						<table style="margin-left:10px;" border="1">
							<tr>
								<?php
								$sql="SELECT * FROM banner";
								$res=mysql_query($sql) or die ("db query failed" .mysql_error());
								while($fet=mysql_fetch_array($res)){
									echo "<td>";
										echo "<table>";
											echo "<tr>";
												echo "<td>";
													echo"<img src='images/banner/{$fet['banner']}' style='width:100px;height:100px;'>";
												echo "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<td>";
													echo"<a href='deletebanner.php?banid={$fet['id']}'><img src='images/Editing-Delete-icon.png' style='width:20px'></a>";
												echo "</td>";
											echo "</tr>";
										echo "</table>";
									echo "</td>";
								}
								?>
							</tr>
						</table>
					</div>
				</tr>
			</table>
			
		</div>
	
	</body>
</html>