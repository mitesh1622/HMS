<?php include "teamservicologin.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Servico-TeamServico-Register</title>
	<script>
  function passwordval()
  {
    var a=document.getElementById("pass").value;  
    var b=document.getElementById("repass").value;
    if(a!=b)
    {
      document.getElementById("messages").innerHTML="**PASSWORDS ARE NOT MATCHING"
      return false;
    }
  }
  </script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    fieldset {
      width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 55px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
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

    input {
      display: block;
      width: 100%;
      padding: 10px;
      margin: 9px -12px;

      border: 1px solid #ccc;
      border-radius: 5px;
    }

    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
	  margin: 10px auto;
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

    span#messages {
      color: red;
    }

    b {
      font-weight: bold;
      color: #4CAF50;
    }

    div {
      margin-top: 20px;
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
	<fieldset>
		<legend align="center">Team Servico Register</legend>
		<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return passwordval()">
		<?php
			if(!isset($_COOKIE['info']))
			{
		?>
			<br>Serial&nbsp;No: <input type="text" name="serial" placeholder="Enter Serial Number"><br><br>
			<button type="submit" name="sno">Get Details</button>
		<?php
			}
			else
			{
				$info=$_COOKIE['info'];
				$D=explode('@@@@@@', $info);
		?>
			<br>Name:&nbsp; <?php echo $D[0]; ?> <br><br>
			Department:&nbsp; <?php echo $D[1]; ?> <br><br>
			Serial&nbsp;No:&nbsp; <?php echo $D[2]; ?> <br><br>
		<?php
			}
			if(isset($_COOKIE['info']))
			{
				$D=explode("@@@@@@", $_COOKIE['info']);
				if(count($D)===3)
				{
		?>
					Mobile&nbsp;No:&nbsp; <input type="text" name="phone" placeholder="Enter your mobile number"><br><br>
					Email:&nbsp;<input type="text" name="email" placeholder="Enter your Email"><br><br>
					Address:<br><textarea rows="5" cols="40" wrap="physical" name="address" placeholder="Enter your address"></textarea><br><br>
					Username:&nbsp;<input type="text" name="uname" placeholder="Create your username"><br><br>
    				Password: <input type="password" name="pass" placeholder="Create your password" id="pass"><br><br>
    				Retype Password: <input type="password" name="repass" placeholder="Create your password" id="repass"><br><span id="messages" style="color:red;"></span><br><br>
    				<b>Note:&nbsp;&nbsp;Password must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters in total</b><br><br>
    	<?php
    			}
    			else
    			{
    	?>		
    				Mobile&nbsp;No:&nbsp; <input type="text" name="phone" value="<?php echo $D[3]; ?>"><br><br>
					Email:&nbsp;<input type="text" name="email" value="<?php echo $D[4]; ?>"><br><br>
					Address:<br><textarea rows="5" cols="40" name="address"><?php echo $D[5]; ?></textarea><br><br>
					Username:&nbsp;<input type="text" name="uname" value="<?php echo $D[6]; ?>"><br><br>
    				Password: <input type="password" name="pass" placeholder="Create your password" id="pass"><br><br>
    				Retype Password: <input type="password" name="repass" placeholder="Create your password" id="repass"><br><span id="messages" style="color:red;"></span><br><br>
    				<b>Note:&nbsp;&nbsp;Password must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters in total</b><br><br>
		<?php
				}
			}
		?>
			<button type="submit" name="sub">Submit</button><br><br>
		</form>
	<?php
		if(isset($_POST['sno']))
		{
			if(empty($_POST['serial']))
			{
				echo '<script>alert("Please Enter Serial Number!")</script>';
        		echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("teamservicoregister.php"); }, 1);</script>';
        		die();
			}
			$sno=mysqli_real_escape_string($db,$_POST['serial']);
			$sql="SELECT * FROM pendingteamservico where sno='$sno'";
			$run=mysqli_query($db,$sql);
			$res=mysqli_fetch_array($run);
			$D=[];
			$D[0]=$res['name'];
			$D[1]=$res['department'];
			$D[2]=$res['sno'];
			$info=implode("@@@@@@", $D);
			setcookie("info",$info,time()+3600);
			echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("teamservicoregister.php"); }, 1);</script>';
		}

		if (isset($_POST['sub']))
		{
			if(!isset($_COOKIE['info']))
			{
				echo '<script>alert("Please Fill Form within 1 hour!!")</script>';
          		die();
			}

			if(empty($_POST['phone']))
        	{
          		echo '<script>alert("Please Enter Mobile Number(We will not disclose in public)")</script>';
          		die();  
        	}
        	else
        	{
        		if (!preg_match("/^[6-9][0-9]{9}$/",$_POST['phone'])) 
          		{
            		echo '<script>alert("Enter valid mobile number")</script>';
            		die();      
          		}
          		else
          		{
            		$D[3]=mysqli_real_escape_string($db, $_POST['phone']);
          		}
        	}

        	if(empty($_POST['email']))
        	{
          		echo '<script>alert("Please Enter Email(We will not disclose in public)")</script>';
          		die();  
        	}
        	else
        	{
          		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
          		{
            		echo '<script>alert("Enter valid email")</script>';
            		die();
          		}
          		else
          		{
            		$D[4]=mysqli_real_escape_string($db, $_POST['email']);
          		}
        	}

        	if(empty($_POST['address']))
        	{
          		echo '<script>alert("Please Enter Address(We will not disclose in public)")</script>';
          		die();  
        	}
        	else
        	{
          		$D[5]=mysqli_real_escape_string($db,$_POST['address']);
          		$D[5]=strip_tags($D[5]);
        	}

        	if(empty($_POST['uname']))
        	{
          		echo '<script>alert("Please Enter Username")</script>';
          		die();
        	}
        	else
        	{
          		$D[6]=mysqli_real_escape_string($db,$_POST['uname']);
          		$sql="SELECT * FROM teamservico WHERE username='$username'";
          		$result=mysqli_query($db,$sql);
          		if(mysqli_num_rows($result)>0)
          		{ 
            		echo '<script>alert("Username already exists")</script>';
            		die();
          		}
        	}

        	if(empty($_POST['pass']))
         	{
           		echo '<script>alert("Please Enter Password")</script>';
           		die();
         	}
         	else
         	{
            	if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $_POST['pass'])) 
            	{
               		echo '<script>alert("Please Enter Password as required")</script>';
               		die();
            	}
            	else
            	{
              		$D[7]=password_hash($_POST['pass'],PASSWORD_BCRYPT);
            	}
        	}

        	$info=implode("@@@@@@", $D);
        	setcookie("info",$info,time()+3600);
        	echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("confirmteamservico.php"); }, 1);</script>';
		}
	?>
	</fieldset>
</body>
</html>