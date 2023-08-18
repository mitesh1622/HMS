<?php
      session_start();

      // initializing variables
      $username = "";
      $password = "";
      $errors = array(); 

      // connect to the database
      $db = mysqli_connect('localhost', 'root', '', 'servico');


      // LOGIN USER
      if ($_SERVER["REQUEST_METHOD"]=="POST" && !isset($_SESSION['username']))
      {
          $username = mysqli_real_escape_string($db, $_POST['username']);
          $password = mysqli_real_escape_string($db, $_POST['password']);

          $s="<html>
  <head>
    <title>NIRMA Admin</title>
  <style>
    .button {
    background-color: #cc0000;
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    cursor: pointer;
  }
  .b {
    background-color: #a6a6a6; 
    color: black; 
    border: 2px solid #cc0000;
  }
  .b:hover {
    background-color: #cc0000;
    color: white;
  }
  </style>
</head>
<body><div align=\"center\"><a href=\"admin.php\"><button class=\"button b\"><b><h1>BACK</h1></b></button></a></div></body></html>";
          if (empty($username)) 
          {
            array_push($errors, "Username is required");
          }
          if (empty($password)) 
          {
            array_push($errors, "Password is required");
          }

          if (count($errors) == 0) 
          {
            $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1)
            {
                $_SESSION['username'] = $username;
                header('location: weladmin.php');
            }
            else
            {
                echo '<script>alert("Wrong Username/Password")</script>';
                echo $s;
            }
          }
          else if(!isset($_SESSION['username']))
          {
              echo '<script>alert("Username/Password required")</script>';
              echo $s;
          }
      }
    ?>