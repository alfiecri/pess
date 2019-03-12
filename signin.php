<!DOCTYPE html>
<html>
<head>
<?php include 'header.php'; ?><br><br>
</head>

<body>
	<?php
	session_start();
	
	if (!empty($_POST) && $_POST[userId] == 'alfierul' && $_POST['password'] == 'password')
	{
		$_SESSION['logged_in'] = true;
		header('Location: /logcall.php');
	}
	else
	{
		?>
		
		<form action="logcall.php" method="post">
	User ID: <input type="text" name="userId">
	<br><br>Password: <input type="password" name="password">
	<br><br><button type="submit">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;
	</form>

	<?php
	}
?><br><br>
</body>
</html>