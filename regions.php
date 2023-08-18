<?php include "adminlogin.php";
	if(!isset($_SESSION['username']))
	{
		header ('location: admin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-System Settings-Regions</title>
</head>
<body>
	<h1 align="center">Region Settings</h1><br><br>
	<div align="right"><a href="logout.php">Logout</a></div>
	<div><a href="system.php">Back</a></div>
	<fieldset>
		<legend align="center">Working Area</legend>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center"><br>
			<button type="submit" name="duniya">Get Details</button><br>
		</form>
		<?php
		if(isset($_POST['duniya']))
		{ 
			$query="SELECT * FROM workingcountry";
			$run=mysqli_query($db,$query);
			$n=mysqli_num_rows($run);
			if($n==0)
			{
				echo "No Countries Registered as working place";
		?>
				<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<button type="submit" name="addcountry">Add Country</button><br><br>
				</form>
		<?php
			}
			else
			{
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
			<br><select name="country">
				<option value="">Select Country</option>
				<?php
					for($i=0;$i<$n;$i++)
					{
						$row=mysqli_fetch_array($run);
				?>
				<option value="<?php echo $row['country'];?>"><?php echo $row['country'];?></option>
				<?php
					}
				?>
			</select><br><br>
			<button type="submit" name="desh">Get Details</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="delcountry">Delete Country</button>
			<div align="right"><button type="submit" name="addcountry">Add Country</button></div>
		</form>
		<?php
			}
		}
			if(isset($_POST['delcountry']))
			{
				if(empty($_POST['country']))
				{
					echo '<script>alert("Choose a Country")</script>';
					die();
				}
				$country = mysqli_real_escape_string($db,$_POST['country']);
				$d1="DELETE FROM workingcountry where country='$country'";
				//Also delete users and employees working in that country
				mysqli_query($db,$d1);
				echo '<script>alert("Alas!!! We are detaching '.$country.' from Servico")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}

			if(isset($_POST['addcountry']))
			{
		?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
					Country: <input type="text" name="ac" placeholder="Enter name of country you want to add" size="33"><br><br>
					<button type="submit" name="adddesh">ADD</button>
				</form>
		<?php
			}
			if(isset($_POST['adddesh']))
			{
				if(empty($_POST['ac']))
				{
					echo '<script>alert("Enter country name")</script>';
					die();
				}
				$country = mysqli_real_escape_string($db,$_POST['ac']);
				$v1= "SELECT * FROM workingcountry where country='$country'";
				$res=mysqli_query($db,$v1);
				$num=mysqli_num_rows($res);
				if($num>0)
				{
					echo '<script>alert("We are already established in '.$country.'")</script>';
					die();	
				}
				$a1 = "INSERT INTO workingcountry values('$country')";
				mysqli_query($db,$a1);
				echo '<script>alert("Congratulations!!! Now we are growing in '.$country.'")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['desh']))
			{
				if(empty($_POST['country']))
				{
					echo '<script>alert("Choose a Country")</script>';
					die();
				}
				$country = mysqli_real_escape_string($db,$_POST['country']);
				$_SESSION['country']=$country;
				echo "<p align=\"center\">".$country."</p>";
				$q1 = "SELECT * FROM workingstate WHERE country='$country'";
				$res = mysqli_query($db,$q1);
				$n1=mysqli_num_rows($res);
				if($n1==0)
				{
					echo "No states registered";
			?>
					<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<button type="submit" name="addstate">Add State</button><br><br>
					</form>
			<?php
				}
				else
				{
			?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
			<br><select name="state">
				<option value="">Select State</option>
				<?php
					for($i=0;$i<$n1;$i++)
					{
						$row=mysqli_fetch_array($res);
				?>
				<option value="<?php echo $row['state'];?>"><?php echo $row['state'];?></option>
				<?php
					}
				?>
			</select><br><br>
			<button type="submit" name="rajya">Get Details</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="delstate">Delete State</button>
			<div align="right"><button type="submit" name="addstate">Add State</button></div>
		</form>		
		<?php
				}
			}
			if(isset($_POST['delstate']))
			{
				$country=$_SESSION['country'];
				echo "<p align=\"center\">".$country."</p>";
				if(empty($_POST['state']))
				{
					echo '<script>alert("Choose a State")</script>';
					die();
				}
				$state = mysqli_real_escape_string($db,$_POST['state']);
				$country=$_SESSION['country'];
				$d2="DELETE FROM workingstate where country='$country' AND state='$state'";
				//Also delete users and employees working in that state
				mysqli_query($db,$d2);
				echo '<script>alert("Alas!!! We are detaching '.$state.' of '.$country.' from Servico")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['addstate']))
			{
				$country=$_SESSION['country'];
				echo "<p align=\"center\">".$country."</p>";
		?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
					State: <input type="text" name="as" placeholder="Enter name of state you want to add" size="33"><br><br>
					<button type="submit" name="addrajya">ADD</button>
				</form>
		<?php
			}
			if(isset($_POST['addrajya']))
			{
				$country=$_SESSION['country'];
				echo "<p align=\"center\">".$country."</p>";
				if(empty($_POST['as']))
				{
					echo '<script>alert("Enter state name")</script>';
					die();
				}
				$state = mysqli_real_escape_string($db,$_POST['as']);
				$country = $_SESSION['country'];
				$a1 = "INSERT INTO workingstate values('$country','$state')";
				$v2= "SELECT * FROM workingstate where country='$country' and state='$state'";
				$res=mysqli_query($db,$v2);
				$num=mysqli_num_rows($res);
				if($num>0)
				{
					echo '<script>alert("We are already established in '.$state.' of '.$country.'")</script>';
					die();	
				}
				mysqli_query($db,$a1);
				echo '<script>alert("Congratulations!!! Now we are growing in '.$state.'")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['rajya']))
			{
				if(empty($_POST['state']))
				{
					echo '<script>alert("Choose a State")</script>';
					die();
				}
				$state = mysqli_real_escape_string($db,$_POST['state']);
				$_SESSION['state']=$state;
				$q2 = "SELECT * FROM workingdistrict WHERE state='$state'";
				$res = mysqli_query($db,$q2);
				$n2=mysqli_num_rows($res);
				$country=$_SESSION['country'];
				echo '<p align="center">'.$country.'->'.$state.'</p>';
				if($n2==0)
				{
					echo "No districts registered";
			?>
					<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<button type="submit" name="adddistrict">Add District</button><br><br>
					</form>
			<?php
				}
				else
				{
			?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
			<br><select name="district">
				<option value="">Select District</option>
				<?php
					for($i=0;$i<$n2;$i++)
					{
						$row=mysqli_fetch_array($res);
				?>
				<option value="<?php echo $row['district'];?>"><?php echo $row['district'];?></option>
				<?php
					}
				?>
			</select><br><br>
			<button type="submit" name="zilla">Get Details</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="deldistrict">Delete District</button>
			<div align="right"><button type="submit" name="adddistrict">Add District</button></div>
		</form>
			<?php
				}
			}
			if(isset($_POST['deldistrict']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				echo '<p align="center">'.$country.'->'.$state.'</p>';
				if(empty($_POST['district']))
				{
					echo '<script>alert("Choose a District")</script>';
					die();
				}
				$district = mysqli_real_escape_string($db,$_POST['district']);
				$d3="DELETE FROM workingdistrict where state='$state' AND district='$district'";
				//Also delete users and employees working in that state
				mysqli_query($db,$d3);
				echo '<script>alert("Alas!!! We are detaching '.$district.' of '.$state.' in '.$country.' from Servico")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['adddistrict']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				echo '<p align="center">'.$country.'->'.$state.'</p>';
		?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
					District: <input type="text" name="ad" placeholder="Enter name of district you want to add" size="33"><br><br>
					<button type="submit" name="addzilla">ADD</button>
				</form>
		<?php
			}
			if(isset($_POST['addzilla']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				echo '<p align="center">'.$country.'->'.$state.'</p>';
				if(empty($_POST['ad']))
				{
					echo '<script>alert("Enter District name")</script>';
					die();
				}
				$district = mysqli_real_escape_string($db,$_POST['ad']);
				$a2 = "INSERT INTO workingdistrict values('$state','$district')";
				$v3= "SELECT * FROM workingdistrict where state='$state' and district='$district'";
				$res=mysqli_query($db,$v3);
				$num=mysqli_num_rows($res);
				if($num>0)
				{
					echo '<script>alert("We are already established in '.$district.' of '.$state.' from '.$country.'")</script>';
					die();
				}
				mysqli_query($db,$a2);
				echo '<script>alert("Congratulations!!! Now we are growing in '.$district.'")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['zilla']))
			{
				if(empty($_POST['district']))
				{
					echo '<script>alert("Choose a District")</script>';
					die();
				}
				$district = mysqli_real_escape_string($db,$_POST['district']);
				$_SESSION['district']=$district;
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				echo '<p align="center">'.$country.'->'.$state.'->'.$district.'</p>';
				$q3 = "SELECT * FROM workingarea WHERE district='$district'";
				$res = mysqli_query($db,$q3);
				$n3=mysqli_num_rows($res);
				if($n3==0)
				{
					echo "No areas registered";
			?>
					<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<button type="submit" name="addarea">Add Area</button><br><br>
					</form>
			<?php
				}
				else
				{
			?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
			<br><select name="area">
				<option value="">Select Area</option>
				<?php
					for($i=0;$i<$n3;$i++)
					{
						$row=mysqli_fetch_array($res);
				?>
				<option value="<?php echo $row['area'];?>"><?php echo $row['area'];?></option>
				<?php
					}
				?>
			</select><br><br>
			<button type="submit" name="ilaka">Show Full Path</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="delarea">Delete Area</button>
			<div align="right"><button type="submit" name="addarea">Add Area</button></div>
		</form>
			<?php
				}
			}

			if(isset($_POST['delarea']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				$district=$_SESSION['district'];
				echo '<p align="center">'.$country.'->'.$state.'->'.$district.'</p>';
				if(empty($_POST['area']))
				{
					echo '<script>alert("Choose an Area")</script>';
					die();
				}
				$area = mysqli_real_escape_string($db,$_POST['area']);
				$d4="DELETE FROM workingarea where district='$district' AND area='$area'";
				//Also delete users and employees working in that state
				mysqli_query($db,$d4);
				echo '<script>alert("Alas!!! We are detaching '.$area.' in '.$district.' of '.$state.' of '.$country.' from Servico")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['addarea']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				$district=$_SESSION['district'];
				echo '<p align="center">'.$country.'->'.$state.'->'.$district.'</p>';
		?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
					Area: <input type="text" name="aa" placeholder="Enter name of area you want to add" size="33"><br><br>
					<button type="submit" name="addilaka">ADD</button>
				</form>
		<?php
			}
			if(isset($_POST['addilaka']))
			{
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				$district=$_SESSION['district'];
				echo '<p align="center">'.$country.'->'.$state.'->'.$district.'</p>';
				if(empty($_POST['aa']))
				{
					echo '<script>alert("Enter Area name")</script>';
					die();
				}
				$area = mysqli_real_escape_string($db,$_POST['aa']);
				$a3 = "INSERT INTO workingarea values('$district','$area')";
				$v4= "SELECT * FROM workingarea where district='$district' and area='$area'";
				$res=mysqli_query($db,$v4);
				$num=mysqli_num_rows($res);
				if($num>0)
				{
					echo '<script>alert("We are already established in '.$area.' in '.$district.' of '.$state.' from '.$country.'")</script>';
					die();
				}
				mysqli_query($db,$a3);
				echo '<script>alert("Congratulations!!! Now we are growing in '.$area.'")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
			if(isset($_POST['ilaka']))
			{
				if(empty($_POST['area']))
				{
					echo '<script>alert("Choose a District")</script>';
					die();
				}
				$area=mysqli_real_escape_string($db,$_POST['area']);
				$country=$_SESSION['country'];
				$state=$_SESSION['state'];
				$district=$_SESSION['district'];
				echo '<p align="center">'.$country.'->'.$state.'->'.$district.'->'.$area.'</p>';
			}
		?>
	</fieldset>
</body>
</html>