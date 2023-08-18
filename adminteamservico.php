<?php include "adminlogin.php";
	if(!isset($_SESSION['username']))
	{
		header ('location: admin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-ADMIN-teamservico</title>
</head>
<body>
	<div align="right"><a href="logout.php">Logout</a></div>
	<fieldset>
		<legend align="center">Team Servico</legend>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
			<br><button type="submit" name="appoint">Appoint Team Servico</button>
		</form>
	</fieldset>
	<?php
		if(isset($_POST['appoint']))
		{
			header('location: appoint.php');
		}
	?>
</body>
</html>