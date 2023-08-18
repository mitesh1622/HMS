<?php include "employeelogin.php"; 
	if(!isset($_SESSION['uname']))
		header('location: employeeregister.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>SERVICO-CONFIRM DETAILS</title>
</head>
<body>
	<fieldset>
		<legend align="center">Confirm Details</legend>
		<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
			<?php
				echo "<br><b>Personal Details:</b><br><br>";
				$image=$_SESSION['image'];
				echo '<img height="400" width="400" src="data:image;base64,'.$image.'"><br><br>';
				$name=$_SESSION['name'];
				echo "Name: ".$name."<br><br>";
				$mobile=$_SESSION['phone'];
				echo "Mobile: ".$mobile."<br><br>";
				$email=$_SESSION['email'];
				echo "Email: ".$email."<br><br>";
				$address=$_SESSION['address'];
				echo "Address: ".$address."<br><br>";
				$username=$_SESSION['uname'];
				echo "Username: ".$username."<br><br>";
				echo "<b>Working Details:</b><br><br>";
				$country=$_SESSION['country'];
				echo "Country: ".$country."<br><br>";
				$state=$_SESSION['state'];
				echo "State: ".$state."<br><br>";
				$district=$_SESSION['district'];
				echo "District: ".$district."<br><br>";
				$area=$_SESSION['area'];
				echo "Area: ".$area."<br><br>";


				echo '<b>Professions & Tools Required:</b><br><br>';
				$p=[];
				?>
				<table align="center">
				<tr align="center">
				<?php
				?>
				<th>No.</th>
				<th><?php echo "Professions"; ?></th>
				<th><?php echo "Tools Required?"; ?></th>
				</tr>
				<?php
				for($i=1;$i<=count($_SESSION['profession']);$i++)
				{
					if($_SESSION['profession'][$i]==="Other")
					{
						$p[$i]="Other"."|||||".$_SESSION['other'][$i]."|||||".$_SESSION['tools'][$i];
						$pro=$_SESSION['other'][$i];
					}
					else
					{
						$p[$i]=$_SESSION['profession'][$i]."|||||".$_SESSION['tools'][$i];
						$pro=$_SESSION['profession'][$i];
					}
					$tools=$_SESSION['tools'][$i];
				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td><?php echo $pro; ?></td>
					<td><?php echo $tools; ?></td>
				</tr>
				<?php
				}
				$s=implode("@@@@@", $p);
				$_SESSION['s']=$s;
			?>
			</table><br><br>
			<input type="checkbox" name="consent">
			<b>I assure that the details provided by me are correct and if any wrong/misleading information is found from my side, then I will accept my rejection from Team Servico</b><br><br>
			<button type="submit" name="back">Back</button>&nbsp;<button type="submit" name="sub">Final Submit</button><br><br>
			<i>It is adviced to review the details.</i>
		</form>
	</fieldset>
	<?php
		if(isset($_POST['back']))
		{
			 echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
		}
		if (isset($_POST['sub']))
		{
			if(empty($_POST['consent']))
			{
				echo '<script>alert("Please mark the agreement!!")</script>';
				echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("workerdetailsconfirm.php"); }, 1);</script>';
				die();
			}
			
		}
	?>
</body>
</html>