<?php include "teamservicologin.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-Team Servico-Confirm Details</title>
</head>
<body>
	<?php
		if(!isset($_COOKIE['info']))
		{
			echo '<script>alert("Please Fill Form within 1 hour!!")</script>';
        	echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("teamservicoregister.php"); }, 1);</script>';
        	die();
		}
		$info=$_COOKIE['info'];
		$D=explode("@@@@@@", $info);
	?>
	<fieldset>
		<legend align="center">CONFIRM DETAILS TEAM SERVICO</legend>
		<form method="post" align="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<br>Name: <?php echo $D[0]; ?><br><br>
			Department: <?php echo $D[1]; ?><br><br>
			Serial Number: <?php echo $D[2]; ?><br><br>
			Mobile: <?php echo $D[3]; ?><br><br>
			Email: <?php echo $D[4]; ?><br><br>
			Address: <?php echo $D[5]; ?><br><br>
			Username: <?php echo $D[6]; ?><br><br>
			<input type="checkbox" name="consent">
			<b>I assure that the details provided by me are correct and if any wrong/misleading information is found from my side, then I will accept my rejection from Team Servico</b><br><br>
			<button type="submit" name="back">Back</button>&nbsp;<button type="submit" name="sub">Final Submit</button><br><br>
			<i>It is adviced to review the details.</i>
		</form>
	</fieldset>
	<?php
		if(isset($_POST['back']))
		{
			 echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("teamservicoregister.php"); }, 1);</script>';
		}
		if (isset($_POST['sub']))
		{
			if(empty($_POST['consent']))
			{
				echo '<script>alert("Please mark the agreement!!")</script>';
				echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("confirmteamservico.php"); }, 1);</script>';
				die();
			}
			
		}
	?>
</body>
</html>