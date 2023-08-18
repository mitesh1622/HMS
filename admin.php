<!DOCTYPE html>
<html>
<head>
	<title>Servico-Admin</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: grey;
			margin: 0;
			padding: 0;
		}

		h1, p {
			text-align: center;
			color: #333;
			margin-top: 30px;
		}

		form {
			width: 300px;
			margin: 0 auto;
			background-color: #fff;
			padding: 50px;
			border-radius: 10px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
		}

		input {
			width: 100%;
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		button {
			width: 100%;
			padding: 10px;
			margin: 3px 9px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		button:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
	<h1 align="center">ADMIN</h1><br><br>
	<p>Please Enter Your Valid Userid And Password</p>
	<form method="post" action="adminlogin.php" align="center">
		Username: <input type="text" name="username" placeholder="Enter Username"><br><br>
		Password: <input type="password" name="password" placeholder="Enter Password"><br><br>
		<button type="submit" name="sub">SUBMIT</button>
	</form>
</body>
</html>