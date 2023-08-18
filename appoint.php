<?php include "adminlogin.php";
	if(!isset($_SESSION['username']))
	{
		header ('location: admin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Team Servico Recruitment</title>
	<style>
		body {
			font-family: "Helvetica Neue", Arial, sans-serif;
			background-color: #f2f2f2;
			margin: 0;
			padding: 0;
		}

		h1 {
			text-align: center;
			color: #4CAF50;
			margin-top: 30px;
		}

		form {
			text-align: right;
			margin-right: 20px;
		}

		/* Back button */
		.back-btn {
			padding: 10px 20px;
			background-color: #f39c12;
			color: #fff;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			transition: background-color 0.3s ease;
			cursor: pointer;
		}

		.back-btn:hover {
			background-color: #f1c40f;
		}

		/* Logout link */
		.logout-link {
			color: #4CAF50;
			text-decoration: none;
		}

		.logout-link:hover {
			color: #45a049;
		}

		fieldset {
			border: 1px solid #ccc;
			padding: 20px;
			border-radius: 5px;
			margin-top: 30px;
			max-width: 400px;
			margin: 0 auto;
			background-color: #fff;
		}

		legend {
			text-align: center;
			font-size: 24px;
			color: #4CAF50;
			font-weight: bold;
		}

		label {
			display: inline-block;
			margin-bottom: 10px;
		}

		input[type="text"], select {
			padding: 8px;
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		button[type="submit"] {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			transition: background-color 0.3s ease;
			cursor: pointer;
			margin-top: 10px;
		}

		button[type="submit"]:hover {
			background-color: #45a049;
		}
	</style>
	
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<button type="submit" name="back">BACK</button>
	</form>
	<div align="right"><a href="logout.php">Logout</a></div>
  <?php
    if(isset($_POST['back']))
    {
    	echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("adminteamservico.php"); }, 1);</script>';
    	if (isset($_COOKIE['info']))
    	{
    		setcookie("info",$_COOKIE['info'],time()-1);
    	}
    }
  ?>
	<fieldset>
		<legend align="center">TEAM SERVICO</legend>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
		<?php
			if(!isset($_COOKIE['info']))
			{
		?>
			<br>Name:&nbsp;<input type="text" name="name" placeholder="Enter Name"><br><br>
				Department:&nbsp;
				<select name="dep">
					<option value="">SELECT</option>
					<option value="operator">Operator</option>
					<option value="communicator">Communication</option>
				</select><br><br>
				Serial&nbsp;Number: <button type="submit" name="gen">Generate Serial</button><br><br>
		<?php
			}
			else
			{
				$D=explode("@@@@@@", $_COOKIE['info']);
		?>
				<br>Name:&nbsp;<input type="text" name="name" value="<?php echo $D[0]; ?>"><br><br>
					Department:&nbsp;
					<select name="dep">
						<option value="">SELECT</option>
						<option value="operator" <?php if($D[1]=="operator"){?> selected="selected" <?php } ?> >Operator</option>
						<option value="communicator" <?php if($D[1]=="communicator"){?> selected="selected" <?php } ?> >Communication</option>
					</select><br><br>
					Serial&nbsp;Number: <?php echo $D[2]; ?><br><br>
		<?php
			}
		?>
		<button type="submit" name="sub">Submit</button>
		</form>

		<?php
			if(isset($_POST['sub']))
			{
				if(empty($_POST['name']))
				{
					echo '<script>alert("Enter Name Sir!")</script>';
        			echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
        			die();
				}

				if(empty($_POST['dep']))
				{
					echo '<script>alert("Select Department Sir!")</script>';
        			echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
        			die();
				}
				$name=mysqli_real_escape_string($db,$_POST['name']);
				$dep=mysqli_real_escape_string($db,$_POST['dep']);
				$sql="INSERT INTO pendingteamservico values('$name','$dep','$D[2]')";
				mysqli_query($db,$sql);
				echo '<script>alert("Recruited Successfully!!")</script>';
				setcookie("info",$_COOKIE['info'],time()-1);
        		echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
			}
		?>

		<?php
			if(isset($_POST['gen']))
			{
				if(empty($_POST['name']))
				{
					echo '<script>alert("Enter Name Sir!")</script>';
        			echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
        			die();
				}

				if(empty($_POST['dep']))
				{
					echo '<script>alert("Select Department Sir!")</script>';
        			echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
        			die();
				}

				$name=mysqli_real_escape_string($db,$_POST['name']);
				$dep=mysqli_real_escape_string($db,$_POST['dep']);
				$sno="";
				if($dep=="operator")
					$sno="O-".rand(111111,999999);
				else
					$sno="C-".rand(111111,999999);
				$sql="SELECT * from pendingteamservico";
				$res=mysqli_query($db,$sql);
				$n=mysqli_num_rows($res);
				$A=[];
				for($i=0;$i<$n;$i++)
				{
					$s=mysqli_fetch_array($res);
					array_push($A, $s['sno']);
				}
				while (in_array($sno, $A))
				{
					if($dep=="operator")
						$sno="O-".rand(111111,999999);
					else
						$sno="C-".rand(111111,999999);
				}
				$C=$name."@@@@@@".$dep."@@@@@@".$sno;
				setcookie("info",$C,time() + 600);
				echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("appoint.php"); }, 1);</script>';
				die();
			}
		?>
	</fieldset>
</body>
</html>