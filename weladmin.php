<?php include "adminlogin.php";
	if(!isset($_SESSION['username']))
	{
		header ('location: admin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-Admin</title>
	<style>
		body {
			font-family: "Helvetica Neue", Arial, sans-serif;
			background-color: grey;
			margin: 0;
			padding: 0;
			
		}

		h1 {
			text-align: center;
			color: #333;
			margin-top: 30px;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			background-color: #4CAF50;
			padding: 10px 0;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
			border-radius: 1300px;
		}

		li {
			margin: 5px;
		}

		li a {
			display: inline-block;
			margin: auto;
			padding: 8px;
			border-radius: 10px;
			text-decoration: none;


		}

		li a:hover {
			background-color: #45a049;
			color: black;
			text-decoration: none;
			border-radius: 10px;
			font-size: 18px;
			transition: background-color 0.3s ease;
			background-color: grey;
		}
		div a{
			text-decoration: none;
    border-radius: 10px;
    background-color: red;
    margin: 13px 108px;
    padding: 13px 27px;
    display: inline-block;
    width: 3%;
	color: black;
}
		
		
	</style>
</head>
<body>
	<h1 align="center">WELCOME ADMIN</h1><br><br>
	<div align="right"><a href="logout.php">Logout</a></div>
	<ul>
	<li><a href="system.php">System</li>
	<li><a href="customer.php">Customers</li>
	<li><a href="adminteamservico.php">Team Servico</li>
	<li><a href="adminemployee.php">Employees</li>
</body>

	</ul>
	
</html>