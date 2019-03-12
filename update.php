<!DOCTYPE html>
<html>
<head>
<?php include 'header.php'; ?><br><br>
</head>

<body>
	<?php
	
	if(!isset($_POST["btnSearch"])){
	
	?>

	<form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
	
	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
	
	<tr>
		<td width="25%" class="td_label">Patrol Car ID : </td>
		<td width="25%" class="td_Data"><input type="text" name="patrolcarid" id="patrolcarid"></td>
		<td class="td_Data"><input type="submit" name="btnSearch" id="btnSearch" value="Search"></td>
	</tr>
	</table>
	</form>
	
	<?php
	} else {
		//echo $_POST["patrolcarid"];
		$con=mysql_connect("localhost","alfierul","password");
		if(!$con)
		{
			die('Cannot connect to database : ' .mysql_error());
		}
	mysql_select_db("25_alfierul_pessdb",$con);
	
	$sql = "SELECT * FROM patrolcarid WHERE patrolcarid='".$_POST['patrolcarid']."'";
	
	$result=mysql_query($sql,$con);
	
	$patrolcarid;
	
	$patrolcarStatusid;
	
	while($row = mysql_fetch_array($result))
	{
		$patrolcarid = $row['patrolcarid'];
		$patrolcarStatusid = $row['patrolcarStatusid'];
	}
	
	$sql = "SELECT * FROM patrolcar_status";
	
	$result = mysql_query($sql,$con);
	
	$patrolCarStatusMaster;
	
	while($row = mysql_fetch_array($result))
	{
		$patrolCarStatusMaster[$row['statusid']]=$row['statusDesc'];
	}
	
	mysql_close($con);
	?>
	
	<form name="form2" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
	
	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
	
	<tr>
		<td width="25%" class="td_label">Patrol Car ID :</td>
		<td width="25%" class="td_Data"><?php echo $_POST["patrolcarid"]?></td>
	</tr>
	
	<tr>
		<td width="25%" class="td_label">Status :</td>
		<td width="25%" class="td_Data"><select name="patrolCarStatus" id="$patrolCarStatus">
		
		<?php foreach( $patrolCarStatusMaster as $key => $value) { ?>
		
		<option value="<?php echo $key ?>"
		<?php if ($key==$patrolcarStatusid) {?> selected="selected"
		<?php }?>>
		<?php echo $value ?>
		</option>
		
		<?php } ?>
		</select></td>
		</tr>
		
		</table>
		
		<br>
		
		<table width="25%" border="0" align="center" cellpadding="4" cellspacing="4">
		
		<tr>
			<td class="td_label"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
			<td class="td_Data"><input type="submit" name="btnUpdate" id="btnUpdate" value="Update"></td>
		</tr>
		<tr>
		<td width="25%" class="td_label">ID :</td>
		<td width="25%" class="td_Data"><?php echo $_POST["patrolcarid"]?></td>
		</tr>
		
		</table>
		</form>
		<?php } ?>
		<?php
		if(isset($_POST["btnUpdate"])){
			
			$con = mysql_connect("localhost","alfierul","password");
			
			if(!$con)
			{
				die('Cannot connect to database :'. mysql_error());
			}
			
			mysql_select_db("25_alfierul_pessdb",$con);
			
			$sql = "UPDATE patrolcarid SET patrolcarStatusid='".$_POST["patrolcarStatusid"]."' WHERE patrolcarid = '".$_POST["patrolcarid"]."'";
			
		if(!mysql_query($sql,$con))
		{
			die('Error4: '.mysql_error());
		}
		$sql="UPDATE incident SET incidentStatusid='3' WHERE incidentid='$incidentid' AND incidentid NOT IN (SELECT incidentid FROM dispatch WHERE timeCompleted IS NULL)";
		
		if(!mysql_query($sql,$con))
		{
			die('Error5: ' .mysql_error());
		}
		mysql_close($con);
		?>
		
		<script type = "text/javascript">window.location="./logcall.php";</script>
			<?php }?>
</body>
</html>