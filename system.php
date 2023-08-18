<!DOCTYPE html>
<html>

<head>
	<title>Servico</title>
	<style>
		body {
			font-family: "Helvetica Neue", Arial, sans-serif;
			background-color: grey;
			margin: 0;
			padding: 0;
		}

		h1 {
			text-align: center;
			color: black;
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

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			background-color: #4CAF50;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
			margin-top: 50px;
		}

		li {
			margin: 10px;
		}

		li a {
			display: block;
			padding: 12px 24px;
			color: grey;
			background-color: black;
			text-decoration: none;
			border-radius: 5px;
			font-size: 18px;
			transition: background-color 0.3s ease;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
			position: relative;
			overflow: hidden;
		}

		li a:hover {
			background-color: grey;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			top: -2px;
		}





		div {
			display: inline-block;
			padding: 10px 25px;
			color: grey;
			background-color: black;
			text-decoration: none;
			border-radius: 5px;
			font-size: 18px;
			transition: background-color 0.3s ease;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
			position: relative;
			overflow: hidden;
			width: 3%;
			margin: -11px 31px;
		}
	</style>
</head>

<body>
	<h1 align="center">WELCOME TO SERVICO</h1><br><br>
	<div align="right"><a href="logout.php">Logout</a></div>
	<div><a href="weladmin.php">Back</a></div>
	<ul>
		<li><a href="regions.php">Regions Settings</a></li>
		<li><a href="professions.php">Profession Settings</li>
	</ul>
</body>

</html>