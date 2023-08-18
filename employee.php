<!DOCTYPE html>
<html>
<head>
	<title>Servico-Employees</title>
	<style>
body {
  font-family: Arial, sans-serif;
  background-color: grey;
  margin: 0;
  padding: 0;
}

header {
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 20px;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  text-align: center;
}

nav li {
  display: inline-block;
  margin-right: 20px;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  transition: color 0.3s ease;
}

nav a:hover {
  color: #666;
}

main {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #333;
  margin-bottom: 20px;
}

form {
  text-align: center;
}

form input[type="text"],
form input[type="password"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
  width: 250px;
}

form button {
  padding: 10px 20px;
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form button:hover {
  background-color: #666;
}

div a {
  text-decoration: none;
  color: #333;
  padding: 33px;
}

div a button {
	padding: 10px 20px;
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

div a button:hover {
  background-color: #666;
}
	</style>
	
</head>
<body>
	<h1 align="center">WELCOME EMPLOYEES!!</h1><br><br>
	<div><a href="home.php">Back</a></div>
	<form action="employeelogin.php" method="post" align="center">
		Username:&nbsp;<input type="text" name="username" placeholder="Enter your username"><br><br><br>
		Password:&nbsp;<input type="password" name="password" placeholder="Enter your password"><br><br><br>
		&nbsp;&nbsp;<button type="submit" name="sub">Submit</button>&nbsp;&nbsp;</form><br><div align="center"><a href="employeeregister.php"><button name="reg">Register</button></a></div>
	</form>
</body>
</html>