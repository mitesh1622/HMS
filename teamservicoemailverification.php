<?php
	include "teamservicologin.php";
	if(!isset($_SESSION['otp']))
	{
		header ('location: teamservicoregister.php');
	}
	$otp=$_SESSION['otp'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-Email Verification</title>
</head>
<body>
	<fieldset>
		<form align="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<legend align="center"><b>One Time Password</b></legend>
			<br><br>OTP*: <input type="text" name="otp" placeholder="Enter OTP sent to your email"><br><br><br><br>
			<input class="reg" type="submit" name="reg" value="Submit">
		</form>
	</fieldset>
	<?php
		if(isset($_POST['reg']))
		{	
			if(empty($_POST['otp']))
			{
				echo '<script>alert("Please Enter OTP")</script>';
				die();
			}
			else
			{
				$otp=$_SESSION['otp'];
				$o=mysqli_real_escape_string($db,$_POST['otp']);
				if($otp!=$o)
				{
					echo '<script>alert("OTP is incorrect")</script>';
				}
				else
				{
					echo '<script>alert("OTP is VALID! Thank You For Registration")</script>';
					$info=$_COOKIE['info'];
					$D=explode("@@@@@@", $info);
					$name=$D[0];
					$department=$D[1];
					$sno=$D[2];
					$mobile=$D[3];;
					$email=$D[4];;
					$address=$D[5];
					$username=$D[6];
					$password=$D[7];

					$sql="INSERT INTO teamservico values('$name','$department','$sno','$mobile','$email','$address','$username','$password')";
					$query="DELETE FROM `pendingteamservico` WHERE sno='$D[2]'";
					mysqli_query($db,$sql);
					mysqli_query($db,$query);
					setcookie("info",$_COOKIE['info'],time()-1);

					$m="Dear Partner,\nGet to your assigned work.\nRegards,\nTeam Servico.";

					mail($email,'NO REPLY',$m,'From: miteshprajapati0871@gmail.com');
					
					echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("teamservicoregister.php"); }, 1);</script>';
				}
			}
		}
	?>
</body>
</html>