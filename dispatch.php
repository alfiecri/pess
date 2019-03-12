<html>
<head>
<?php include 'header.php'; ?><br><br>
</head>

<body>
<?php
	
	$con = mysql_connect("localhost","alfierul","password");
	if(!$con)
	{
		die('Cannot connect to database : ' .mysql_error());
	}
	
	mysql_select_db("25_alfierul_pessdb",$con);
	
	$sql = "SELECT patrolcarid, patrolcarStatusid FROM patrolcarid JOIN patrolcar_status ON patrolcarid.patrolcarid=patrolcarid.patrolcarStatusid WHERE patrolcarid.patrolcarStatusid='2' OR patrolcar_status.statusId='3'";

	$result = mysql_query($sql, $con);
	
	$incidentArray;
	$count=0;
	
	while($row = mysql_fetch_array($result))
	{
		$patrolcarArray[$count]=$row;
		$count++;
	}
	
	if(!mysql_query($sql,$con))
	{
		die('Error: '.mysql_error());
	}
	
	mysql_close($con);
	

	?>
	
	<table width="40%" border="1" align="center" cellpadding="4" cellspacing="8">
	
		<tr>
			<td width="20%">&nbsp;</td>
			<td width="51%">Patrol Car ID</td>
			<td width="29%">Status</td>
		</tr>
		
	<?php
		$i=0;
		while($i < $count) {
	?>
	
	<tr>
		<td class="td_label"><input type="checkbox" name="chkPatrolcar[]" value="<?php echo $patrolcarArray[$i]['patrolcarid'] ?></td>
		<td><?php echo $patrolcarArray[$i]['patrolcarid']?></td>
		<td><?php echo $patrolcarArray[$i]['patrolcarStatusid']?></td>
	</tr>
	
	<?php $i++;
	} ?>
		
	</table>
	
	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
			<td width="46%" class="td_label"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
			<td width="54%" class="td_Data">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"></td>
	</table>
	
	<?php
	
		if(isset($_POST["btnSubmit"]))
		{
			// connect to database
			$con = mysql_connect("localhost","alfierul","password");
		}	
			if(!$con)
			{
				die('Cannot connect to database :' . mysql_error());
			}
			
			mysql_select_db("25_alfierul_pessdb",$con);
			
			$patrolcarDispatched = $_POST["chkPatrolcar"];
			
			$c = count($patrolcarDispatched);
			
		$status;
			if($c > 0) {
				$status='2';
			}
			else {
				$status='1';
			}
			
			$sql = "INSERT INTO incident (callerName, phoneNo, incidentLocation, incidentTypeid, incidentDesc, incidentStatusid) VALUES ('".$_POST['callerName']."', '".$_POST['phoneNo']."', '".$_POST['incidentLocation']."', '".$_POST['incidentTypeid']."', '".$_POST['incidentDesc']."', '$status')";
			
			if(!mysql_query($sql,$con))
			{
				die('Error1: '. mysql_error());
			}
			
			$incidentid=mysql_insert_id($con);
			
			for($i=0; $i < $c; $i++)
			{
				$sql = "UPDATE patrolcarid SET patrolcarStatusid='1' WHERE patrolcarid='$patrolcarDispatched[$i]'";
				
				if(!mysql_query($sql,$con))
				{
					die('Error2:'.mysql_error());
				}
				
				$sql = "INSERT INTO dispatch(incidentid, patrolcarid, timeDispatched) VALUES ('$incidentid','$patrolcarDispatched[$i]',NOW())";
				
				if(!mysql_query($sql,$con))
				{
					die('Error3: '.mysql_error());
				}
			}
		mysql_close($con);
	
	?>
</body>
</html>