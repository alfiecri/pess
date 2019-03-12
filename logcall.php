<!DOCTYPE html>
<html>
<head>
<?php include 'header.php'; ?><br><br>
</head>

<body>
	<?php
	if(isset($_POST["btnSubmit"])){
			
			$con = mysql_connect("localhost","alfierul","password");
			
			if(!$con)
			{
				die('Cannot connect to database :'. mysql_error());
			}
			
			mysql_select_db("25_alfierul_pessdb",$con);
		
			mysql_select_db("25_alfierul_pessdb",$con);
		
			$sql = "INSERT INTO incident (callerName, phoneNo, incidentTypeid, incidentLocation, incidentDesc, incidentStatusid) VALUES ('$_POST[callerName]', '$_POST[phoneNo]','$_POST[incidentType]','$_POST[incidentLocation]','$_POST[incidentDesc]','1')";
			if(!mysql_query($sql,$con))
			{
				die('Error: '.mysql_error());
			}
			
			mysql_close($con);
			?>
		
			<script type = "text/javascript">window.location="./dispatch.php";</script>
				<?php }?>

		<?php
			$con = mysql_connect("localhost","alfierul","password");
			if(!$con)
			{
			die('Cannot connect to database : ' .mysql_error());
		}
		
		mysql_select_db("25_alfierul_pessdb",$con);
		
		$result = mysql_query("SELECT * FROM incidenttype");
		
		$incidenttype;
		
		while($row = mysql_fetch_array($result))
		{
			$incidentType[$row['incidentTypeid']] = $row['incidentTypeDesc'];
		}
		
		mysql_close($con);
	?>
	
<form name="frmLogCall" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
<fieldset>
<legend><strong>Log Call</strong></legend>
	<table>
	
		<tr>
			<td class="td_label">Caller Name : </td>
			<td class="td_Data">
				<input type="text" name="callerName" id="callerName"><br><br>
			</td>
		</tr>
		
		<tr>
			<td class="td_label">Contact No : </td>
			<td class="td_Data">
				<input type=text name="phoneNo" id="phoneNo"><br><br>
			</td>
		</tr>
		
		<tr>
			<td class="td_label">Location : </td>
			<td class="td_Data">
			
				<input type=text name="incidentLocation" id="incidentLocation"> <br><br>
				
			</td>
		</tr>
		
		<tr>
			<td class="td_label">Incident Type : </td>
			<td class="td_Date">
				
				<select name="incidentType" id="incidentType">
				
				<?php foreach( $incidentType as $key => $value){ ?>
				
				<option value="<?php echo $key ?>"><?php echo $value ?></option>
				<?php } ?>
				
				</select>
			</td>
		</tr>
		<tr>
			<td class="td_label">Description : </td>
			<td class="td_Data">
				<br><br><textarea name="incidentDesc" id="incidentDesc" rows="10" cols="50"></textarea>
			</td>
		</tr>
		
		<tr>
			<td class="td_Data"><input type="reset"  name="btnReset" value="Reset"></td>
			<td class="td_Data"><input type="submit" name="btnSubmit" value="Process Call...">
			</td>
		</tr>
	</table>
</fieldset>
</form>
</body>
</html>