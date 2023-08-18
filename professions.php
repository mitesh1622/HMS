<?php include "adminlogin.php";
	if(!isset($_SESSION['username']))
	{
		header ('location: admin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-System Settings-Professions</title>
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

		div {
			text-align: right;
			margin-right: 20px;
		}

		a {
			text-decoration: none;
			color: #4CAF50;
			font-size: 16px;
			transition: color 0.3s ease;
		}

		a:hover {
			color: #45a049;
		}

		fieldset {
			width: 70%;
			margin: 50px auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
			margin-top: 50px;
		}

		legend {
			text-align: center;
			font-size: 24px;
			font-weight: bold;
			color: #4CAF50;
			margin-bottom: 20px;
		}

		form {
			text-align: center;
		}

		button {
			padding: 10px 20px;
			margin: 4px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			transition: background-color 0.3s ease;
			cursor: pointer;
		}

		button:hover {
			background-color: #45a049;
		}

		table {
			border-collapse: collapse;
			width: 70%;
			margin: 20px auto;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 12px 24px;
			text-align: center;
			border: 1px solid #ccc;
		}

		h2 {
			text-align: center;
			color: #4CAF50;
			margin-top: 20px;
		}

		input[type="text"] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 300px;
			margin-bottom: 15px;
			margin-top: 16px;
		}

		input[type="text"]:focus {
			outline: none;
			border-color: #4CAF50;
		}
	</style>
</head>
<body>
	<h1 align="center">Professions Settings</h1><br><br>
	<div align="right"><a href="logout.php">Logout</a></div>
	<div><a href="system.php">Back</a></div>
	<fieldset>
		<legend align="center">Professions</legend>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center"><br>
			<button type="submit" name="details">Get Details</button><br><br>
		<?php
			if(isset($_POST['details']) || isset($_SESSION['postgetdetails']))
			{
				$query="SELECT * FROM professions";
				$run=mysqli_query($db,$query);
				$n=mysqli_num_rows($run);
				if($n==0)
				{
		?>
			<h2 align="center">No Professions Registered!!</h2>
		<?php
				}
				else
				{
		?>
			<table border="1" cellpadding="10" align="center">
				<tr align="center">
					<th>Professions</th>
				</tr>
		<?php
					for($i=0;$i<$n;$i++)
					{
						$row=mysqli_fetch_array($run);
		?>
				<tr align="center" style="font-size:15px">
					<td>
						<?php echo $row['professions']; ?>
					</td>
				</tr>			
		<?php
						if(!isset($_SESSION['postgetdetails']))
							$_SESSION['postgetdetails']=$_POST['details'];
					}
				}
			}
		?>
		</table><br><br>
		<?php
			if(isset($_SESSION['postgetdetails']))
			{
				if(!isset($_POST['delprofession']))
				{
		?>
		<button align="center" type="submit" name="delprofession">DELETE PROFESSION</button>&nbsp;&nbsp;
		<?php
				}
				else
				{
			if(isset($_POST['delprofession']))
			{
		?>      
      		Profession:&nbsp;<input list="pro" name="pro">
      		<datalist id="pro">
      		<?php
        		$query="SELECT * FROM professions";
        		$run=mysqli_query($db,$query);
        		$n=mysqli_num_rows($run);
        		for($i=0;$i<$n;$i++)
        		{
         			$row=mysqli_fetch_array($run);
      		?>
        	<option value="<?php echo $row['professions']; ?>">
      		<?php
        		}
      		?>
      		</datalist>&nbsp;&nbsp;<button type="submit" name="del">DELETE</button><br><br>
		<?php
			}
		}
		}
		?>
	</form>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" align="right">
		<button type="submit" name="addprofession">ADD PROFESSION</button>
	</form>
	<?php
		if(isset($_POST['del']))
		{
			if(empty($_POST['pro']))
			{
				echo '<script>alert("Choose a Profession to delete")</script>';
				die();
			}
			$profession = mysqli_real_escape_string($db,$_POST['pro']);
			$v1="SELECT * FROM professions where professions='$profession'";
			$n=mysqli_num_rows(mysqli_query($db,$v1));
			if($n==0)
			{
				echo '<script>alert("Profession \"'.$profession.'\" is not registered")</script>';
				die();	
			}
			$d1="DELETE FROM professions where professions='$profession'";
			//Also delete users and employees working in that country
			mysqli_query($db,$d1);
			echo '<script>alert("Removed \"'.$profession.'\" from professions successfully")</script>';
			$page = $_SERVER['PHP_SELF'];
			$sec = "0.1";
			header("Refresh: $sec; url=$page");
		}
		if(isset($_POST['addprofession']))
			{
		?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
					Profession: <input type="text" name="ap" placeholder="Enter Profession" size="23"><br><br>
					<button type="submit" name="addpro">ADD</button>
				</form>
		<?php
			}
			if(isset($_POST['addpro']))
			{
				if(empty($_POST['ap']))
				{
					echo '<script>alert("Enter Profession")</script>';
					die();
				}
				$profession = mysqli_real_escape_string($db,$_POST['ap']);
				$v1= "SELECT * FROM professions where professions='$profession'";
				$res=mysqli_query($db,$v1);
				$num=mysqli_num_rows($res);
				if($num>0)
				{
					echo '<script>alert("Profession \"'.$profession.'\" already registered")</script>';
					die();
				}
				$a1 = "INSERT INTO professions values('$profession')";
				mysqli_query($db,$a1);
				echo '<script>alert("New Profession \"'.$profession.'\" added successfully")</script>';
				$page = $_SERVER['PHP_SELF'];
				$sec = "0.1";
				header("Refresh: $sec; url=$page");
			}
	?>
	</fieldset>
</body>
</html>