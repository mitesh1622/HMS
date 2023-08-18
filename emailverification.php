<?php
	include "employeelogin.php";
	if(!isset($_SESSION['otp']))
	{
		header ('location: employeeregister.php');
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
					$country=$_SESSION['country'];
					$state=$_SESSION['state'];
					$district=$_SESSION['district'];
					$area=$_SESSION['area'];
					$professions=$_SESSION['s'];
					$email=$_SESSION['email'];
					$name=$_SESSION['name'];
					$photo=$_SESSION['image'];
					$mobile=$_SESSION['phone'];
					$username=$_SESSION['uname'];
					$password=$_SESSION['pass'];

					$sql="INSERT INTO pendingregistrations values('$country','$state','$district','$area','$professions','$name','$photo','$mobile','$email','$username','$password')";
					mysqli_query($db,$sql);
					unset($_SESSION['country']);
					unset($_SESSION['state']);
					unset($_SESSION['district']);
					unset($_SESSION['area']);
					unset($_SESSION['s']);
					unset($_SESSION['profession']);
					unset($_SESSION['tools']);
					unset($_SESSION['other']);
					unset($_SESSION['name']);
					unset($_SESSION['image']);
					unset($_SESSION['email']);
					unset($_SESSION['phone']);
					unset($_SESSION['uname']);
					unset($_SESSION['pass']);

					$m="Dear,\nThank you for choosing to work with Servico. Our Team will review your details and will update to you through your mobile number and email. Our agent will connect with you to verify your skills as it's a part of our procedure. We will then update you regarding your acceptance of registration in Team Servico.\nRegards,\nTeam Servico.";

					mail($email,'NO REPLY',$m,'From: miteshprajapati0871@gmail.com');
					
					echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employee.php"); }, 1);</script>';
				}
			}
		}
	?>
</body>
</html>