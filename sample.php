<!DOCTYPE html>
<html>
<head>
	<title>Sample</title>
</head>
<body>
	<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'servico');
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<?php
			$count=0;
			if(!isset($_SESSION['count']))
				$count=1;
			else
			{
				$count=$_SESSION['count'];
			}
			for($i=1;$i<=$count;$i++)
			{
		?>
				Profession&nbsp;<?php echo $i; ?>:<input type="text" name="profession<?php echo $i; ?>" placeholder="Enter profession">
		<?php   if($i==1)
				{
		?>
				<button type="submit" name="add">ADD</button><br>
		<?php
				}
				else
				{
		?>
				<button type="submit" name="X">X</button><br>
		<?php
				}
		?>
		<?php
			}
		?>
		<button type="submit" name="sub">Submit</button>
	</form>
	<?php
		if(isset($_POST['add']))
		{
			if($count==5)
			{
				echo '<script>alert("You can add only 5 professions at a time")</script>';
				die();
			}
			$count++;
			$_SESSION['count']=$count;
			header('location: sample.php');
		}
		if(isset($_POST['X']))
		{	
			if($count>1)
				$count--;
			$_SESSION['count']=$count;
			header('location: sample.php');
		}

		if(isset($_POST['sub']))
		{
			$count=$_SESSION['count'];
			$profession="";
			for($i=1;$i<=$count;$i++)
			{
				$profession=$profession.mysqli_real_escape_string($db,$_POST['profession'.$i]);
			}
			echo $profession;
		}
	?>
</body>
</html>