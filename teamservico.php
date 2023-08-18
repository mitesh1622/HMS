<!DOCTYPE html>
<html>

<head>
  <title>Servico-TeamServico</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #4CAF50;
      margin-top: 30px;
    }

    form {
      width: 300px;
      margin: 0 auto;
      background-color: #fff;
      padding: 43px;
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
      margin: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    div {

      display: inline-block;
      margin: 28px 670px;
      width: 10%;
      padding: 10px 20px;

      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    a {
      text-decoration: none;
    }

    .register-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #f39c12;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .register-btn:hover {
      background-color: #f1c40f;
    }
  </style>
</head>

<body>
  <h1 align="center">TEAM SERVICO</h1><br><br>
  <form method="post" action="teamservicologin.php" align="center">
    Username: <input type="text" name="username" placeholder="Enter Username"><br><br>
    Password: <input type="password" name="password" placeholder="Enter Password"><br><br>
    <button type="submit" name="sub">Submit</button><br><br>
  </form>
  <div align="center"><a href="teamservicoregister.php"><button name="reg">Register</button></a></div>
</body>

</html>