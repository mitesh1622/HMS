<?php include "employeelogin.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Servico-Employees(Registration)</title>
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
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <button type="submit" name="back">BACK</button>
  </form>
  <?php
    if(isset($_POST['back']))
    {
      unset($_SESSION['profession']);
      unset($_SESSION['other']);
      unset($_SESSION['tools']);
      unset($_SESSION['count']);
      unset($_SESSION['country']);
      unset($_SESSION['state']);
      unset($_SESSION['district']);
      unset($_SESSION['area']);
      echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employee.php"); }, 1);</script>';
    }
  ?>
  <fieldset>
    <legend align="center">EMPLOYEE REGISTRATION</legend><br><br>
      <div align="center">Working Details:</div><br>
      <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <?php
        if(!isset($_SESSION['country']))
        {
      ?>
      Country:&nbsp;<input list="country" name="country">
      <?php
        }
        else
        {
          $country=$_SESSION['country'];
      ?>
      Country:&nbsp;<input list="country" name="country" value="<?php echo $country; ?>">
      <?php
        }
      ?>
      <datalist id="country">
      <?php
        $query="SELECT * FROM workingcountry";
        $run=mysqli_query($db,$query);
        $n=mysqli_num_rows($run);
        for($i=0;$i<$n;$i++)
        {
          $row=mysqli_fetch_array($run);
      ?>
        <option value="<?php echo $row['country']; ?>">
      <?php
        }
      ?>
      </datalist>&nbsp;&nbsp;<button type="submit" name="desh">Select Country</button></form><br>
      <?php
      if(isset($_SESSION['country']))
      {
      ?>
      <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <?php
        if(!isset($_SESSION['state']))
        {
      ?>
      State:&nbsp;<input list="state" name="state">
      <?php
        }
        else
        {
          $state=$_SESSION['state'];
      ?>
      State:&nbsp;<input list="state" name="state" value="<?php echo $state; ?>">
      <?php
        }
      ?>
      <datalist id="state">
      <?php
        $country=$_SESSION['country'];
        $query="SELECT * FROM workingstate where country='$country'";
        $run=mysqli_query($db,$query);
        $n=mysqli_num_rows($run);
        for($i=0;$i<$n;$i++)
        {
          $row=mysqli_fetch_array($run);
      ?>
        <option value="<?php echo $row['state']; ?>">
      <?php
        }
      ?>
      </datalist>&nbsp;&nbsp;<button type="submit" name="rajya">Select State</button></form><br>
      <?php
      }
      ?>
      
      <?php
      if(isset($_SESSION['state']))
      {
      ?>
      <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <?php
        if(!isset($_SESSION['district']))
        {
      ?>
      District:&nbsp;<input list="district" name="district">
      <?php
        }
        else
        {
          $district=$_SESSION['district'];
      ?>
      District:&nbsp;<input list="district" name="district" value="<?php echo $district; ?>">
      <?php
        }
      ?>
      <datalist id="district">
      <?php
        $state=$_SESSION['state'];
        $query="SELECT * FROM workingdistrict where state='$state'";
        $run=mysqli_query($db,$query);
        $n=mysqli_num_rows($run);
        for($i=0;$i<$n;$i++)
        {
          $row=mysqli_fetch_array($run);
      ?>
        <option value="<?php echo $row['district']; ?>">
      <?php
        }
      ?>
      </datalist>&nbsp;&nbsp;<button type="submit" name="zilla">Select District</button></form><br>
      <?php
      }
      ?>

      <?php
      if(isset($_SESSION['district']))
      {
      ?>
      <form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <?php
        if(!isset($_SESSION['area']))
        {
      ?>
      Area:&nbsp;<input list="area" name="area">
      <?php
        }
        else
        {
          $area=$_SESSION['area'];
      ?>
      Area:&nbsp;<input list="area" name="area" value="<?php echo $area; ?>">
      <?php
        }
      ?>
      <datalist id="area">
      <?php
        $district=$_SESSION['district'];
        $query="SELECT * FROM workingarea where district='$district'";
        $run=mysqli_query($db,$query);
        $n=mysqli_num_rows($run);
        for($i=0;$i<$n;$i++)
        {
          $row=mysqli_fetch_array($run);
      ?>
        <option value="<?php echo $row['area']; ?>">
      <?php
        }
      ?>
      </datalist>&nbsp;&nbsp;<button type="submit" name="ilaka">Select Area</button></form><br>
      <?php
      }
      ?>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" align="center">
      Profession&nbsp;Details:<br><br>
      <table align="center" border="1" cellpadding="4">
        <tr>
          <th>No.</th>
          <th>Professions</th>
          <th>Tools Required?</th>
          <th colspan="2"></th>
        </tr>
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
        if(!isset($_SESSION['profession'][$i]))
        {
      ?>
        <tr align="center">
          <td>
        <?php echo $i; ?>
          </td>
          <td>
          <input list="profession<?php echo $i; ?>" name="profession<?php echo $i; ?>">
      <?php
        }
        else
        {
          $pro[$i]=$_SESSION['profession'][$i];
          $othpro[$i]="";
      ?>
        <td>
        <?php echo $i; ?>
      </td>
      <td>
        <input list="profession<?php echo $i; ?>" value="<?php echo $pro[$i]; ?>" name="profession<?php echo $i; ?>">
      <?php
          if($pro[$i]==="Other")
          {

              if(!isset($_SESSION['other'][$i]))
              {
      ?>
        <br><br><input type="text" name="other<?php echo $i; ?>" placeholder="Enter profession">
      <?php
              }
              else
              {
                $othpro[$i]=$_SESSION['other'][$i];
        ?>
        <br><br><input type="text" name="other<?php echo $i; ?>" value="<?php echo $othpro[$i]; ?>">
        <?php
              }
          }
        }
      ?>
          <datalist id="profession<?php echo $i; ?>">
          <?php
            $query="SELECT * FROM professions";
            $run=mysqli_query($db,$query);
            $n=mysqli_num_rows($run);
            for($j=0;$j<$n;$j++)
            {
              $row=mysqli_fetch_array($run);
          ?>
          <option value="<?php echo $row['professions']; ?>">
          <?php
            }
          ?>
          <option value="Other">
          </datalist></td>
          <td>
          <?php
            if(!isset($_SESSION['tools'][$i]))
            {
          ?>
            <input type="radio" name="tools<?php echo $i; ?>" value="Yes">Yes&nbsp;&nbsp;<input type="radio" name="tools<?php echo $i; ?>" value="No">No
          <?php
            }
            else
            {
              if($_SESSION['tools'][$i]==="Yes")
              {
          ?><input type="radio" name="tools<?php echo $i; ?>" value="Yes" checked="checked">Yes&nbsp;&nbsp;<input type="radio" name="tools<?php echo $i; ?>" value="No">No
            <?php
              }
              else
              {
            ?>
               <input type="radio" name="tools<?php echo $i; ?>" value="Yes">Yes&nbsp;&nbsp;<input type="radio" name="tools<?php echo $i; ?>" value="No" checked="checked">No 
            <?php
              }
            ?>
          <?php
            }
          ?>
          </td>
          <td>
            <button type="submit" name="sel<?php echo $i; ?>">SELECT</button>
          </td>
    <?php  
       if($i==1)
        {
    ?>
        <td><button type="submit" name="add">ADD</button></td></tr>
    <?php
        }
        else
        {
    ?>
        <td><button type="submit" name="X">X</button></td></tr>
    <?php
        }
    ?>
    <?php
      }
    ?>
  </table><br>
  </form>
  <?php
    if(isset($_POST['sel1']))
    {
      if(empty($_POST['profession1']))
      {
        echo '<script>alert("Fill Profession 1")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
      if(empty($_POST['tools1']))
      {
        echo '<script>alert("Select Yes/No for the tools required in profession 1")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
        $var=mysqli_real_escape_string($db,$_POST['profession1']);
        $tools=mysqli_real_escape_string($db,$_POST['tools1']);

        if($var==="Other")
        {
          if(!isset($_SESSION['profession'][1]) || $_SESSION['profession'][1]!=="Other")
          {
            $_SESSION['profession'][1]=$var;
            $_SESSION['tools'][1]=$tools;
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();
          }
          else
          {
            if(empty($_POST['other1']))
            {
              echo '<script>alert("Write name of profession!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die();
            }
            $oth=mysqli_real_escape_string($db,$_POST['other1']);
            if(isset($_SESSION['other']) && in_array($oth, $_SESSION['other']))
            {
              echo '<script>alert("You have already written this profession as other!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $q="SELECT * FROM professions where professions='$oth'";
            $r=mysqli_query($db,$q);
            $no=mysqli_num_rows($r);
            if($no==1)
            {
              echo '<script>alert("We have this profession!! Please Select from the list!!")</script>';
              unset($_SESSION['profession'][1]);
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $_SESSION['other'][1]=$oth;
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        $q="SELECT * FROM professions where professions='$var'";
        $r=mysqli_query($db,$q);
        $no=mysqli_num_rows($r);
        if($no==0)
        {
          echo '<script>alert("There are no such professions registered!! You may choose \"Other\" option and suggest professions which will be later approved by team servico")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        else
        {
          if(isset($_SESSION['profession']) && in_array($var, $_SESSION['profession']))
          {
            echo '<script>alert("You have already selected \"'.$var.'\" as profession")</script>';
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();  
          }
          if(isset($_SESSION['profession'][1]) && $_SESSION['profession'][1]==="Other")
            unset($_SESSION['other'][1]);
          $_SESSION['profession'][1]=$var;
          $_SESSION['tools'][1]=$tools;
          if(!isset($_SESSION['count']))
          {
            echo '<script>alert("If you select '."YES".' for tools, then you need to pay 1000 rupees as a deposit to SERVICO after your profile is approved by TEAM SERVICO")</script>';
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        }
    }

    if(isset($_POST['sel2']))
    {
      if(empty($_POST['profession2']))
      {
        echo '<script>alert("Fill Profession 2")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
      if(empty($_POST['tools2']))
      {
        echo '<script>alert("Select Yes/No for the tools required in profession 2")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
        $var=mysqli_real_escape_string($db,$_POST['profession2']);
        $tools=mysqli_real_escape_string($db,$_POST['tools2']);

        if($var==="Other")
        {
          if(!isset($_SESSION['profession'][2]) || $_SESSION['profession'][2]!=="Other")
          {
            $_SESSION['profession'][2]=$var;
            $_SESSION['tools'][2]=$tools;
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();
          }
          else
          {
            if(empty($_POST['other2']))
            {
              echo '<script>alert("Write name of profession!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die();
            }
            $oth=mysqli_real_escape_string($db,$_POST['other2']);
            if(isset($_SESSION['other']) && in_array($oth, $_SESSION['other']))
            {
              echo '<script>alert("You have already written this profession as other!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $q="SELECT * FROM professions where professions='$oth'";
            $r=mysqli_query($db,$q);
            $no=mysqli_num_rows($r);
            if($no==1)
            {
              echo '<script>alert("We have this profession!! Please Select from the list!!")</script>';
              unset($_SESSION['profession'][2]);
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $_SESSION['other'][2]=$oth;
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        $q="SELECT * FROM professions where professions='$var'";
        $r=mysqli_query($db,$q);
        $no=mysqli_num_rows($r);
        if($no==0)
        {
          echo '<script>alert("There are no such professions registered!! You may choose \"Other\" option and suggest professions which will be later approved by team servico")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        else
        {
          if(isset($_SESSION['profession']) && in_array($var, $_SESSION['profession']))
          {
            echo '<script>alert("You have already selected \"'.$var.'\" as profession")</script>';
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();  
          }
          if(isset($_SESSION['profession'][2]) && $_SESSION['profession'][2]==="Other")
            unset($_SESSION['other'][2]);
          $_SESSION['profession'][2]=$var;
          $_SESSION['tools'][2]=$tools;
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        }
    }

    if(isset($_POST['sel3']))
    {
      if(empty($_POST['profession3']))
      {
        echo '<script>alert("Fill Profession 3")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
      if(empty($_POST['tools3']))
      {
        echo '<script>alert("Select Yes/No for the tools required in profession 3")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
        $var=mysqli_real_escape_string($db,$_POST['profession3']);
        $tools=mysqli_real_escape_string($db,$_POST['tools3']);

        if($var==="Other")
        {
          if(!isset($_SESSION['profession'][3]) || $_SESSION['profession'][3]!=="Other")
          {
            $_SESSION['profession'][3]=$var;
            $_SESSION['tools'][3]=$tools;
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();
          }
          else
          {
            if(empty($_POST['other3']))
            {
              echo '<script>alert("Write name of profession!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die();
            }
            $oth=mysqli_real_escape_string($db,$_POST['other3']);
            if(isset($_SESSION['other']) && in_array($oth, $_SESSION['other']))
            {
              echo '<script>alert("You have already written this profession as other!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $q="SELECT * FROM professions where professions='$oth'";
            $r=mysqli_query($db,$q);
            $no=mysqli_num_rows($r);
            if($no==1)
            {
              echo '<script>alert("We have this profession!! Please Select from the list!!")</script>';
              unset($_SESSION['profession'][3]);
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $_SESSION['other'][3]=$oth;
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        $q="SELECT * FROM professions where professions='$var'";
        $r=mysqli_query($db,$q);
        $no=mysqli_num_rows($r);
        if($no==0)
        {
          echo '<script>alert("There are no such professions registered!! You may choose \"Other\" option and suggest professions which will be later approved by team servico")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        else
        {
          if(isset($_SESSION['profession']) && in_array($var, $_SESSION['profession']))
          {
            echo '<script>alert("You have already selected \"'.$var.'\" as profession")</script>';
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();  
          }
          if(isset($_SESSION['profession'][3]) && $_SESSION['profession'][3]==="Other")
            unset($_SESSION['other'][3]);
          $_SESSION['profession'][3]=$var;
          $_SESSION['tools'][3]=$tools;
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        }
    }

    if(isset($_POST['sel4']))
    {
      if(empty($_POST['profession4']))
      {
        echo '<script>alert("Fill Profession 4")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
      if(empty($_POST['tools4']))
      {
        echo '<script>alert("Select Yes/No for the tools required in profession 4")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
        $var=mysqli_real_escape_string($db,$_POST['profession4']);
        $tools=mysqli_real_escape_string($db,$_POST['tools4']);

        if($var==="Other")
        {
          if(!isset($_SESSION['profession'][4]) || $_SESSION['profession'][4]!=="Other")
          {
            $_SESSION['profession'][4]=$var;
            $_SESSION['tools'][4]=$tools;
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();
          }
          else
          {
            if(empty($_POST['other4']))
            {
              echo '<script>alert("Write name of profession!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die();
            }
            $oth=mysqli_real_escape_string($db,$_POST['other4']);
            if(isset($_SESSION['other']) && in_array($oth, $_SESSION['other']))
            {
              echo '<script>alert("You have already written this profession as other!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $q="SELECT * FROM professions where professions='$oth'";
            $r=mysqli_query($db,$q);
            $no=mysqli_num_rows($r);
            if($no==1)
            {
              echo '<script>alert("We have this profession!! Please Select from the list!!")</script>';
              unset($_SESSION['profession'][4]);
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $_SESSION['other'][4]=$oth;
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        $q="SELECT * FROM professions where professions='$var'";
        $r=mysqli_query($db,$q);
        $no=mysqli_num_rows($r);
        if($no==0)
        {
          echo '<script>alert("There are no such professions registered!! You may choose \"Other\" option and suggest professions which will be later approved by team servico")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        else
        {
          if(isset($_SESSION['profession']) && in_array($var, $_SESSION['profession']))
          {
            echo '<script>alert("You have already selected \"'.$var.'\" as profession")</script>';
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();  
          }
          if(isset($_SESSION['profession'][4]) && $_SESSION['profession'][4]==="Other")
            unset($_SESSION['other'][4]);
          $_SESSION['profession'][4]=$var;
          $_SESSION['tools'][4]=$tools;
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        }
    }

    if(isset($_POST['sel5']))
    {
      if(empty($_POST['profession5']))
      {
        echo '<script>alert("Fill Profession 5")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
      if(empty($_POST['tools5']))
      {
        echo '<script>alert("Select Yes/No for the tools required in profession 5")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        die();
      }
        $var=mysqli_real_escape_string($db,$_POST['profession5']);
        $tools=mysqli_real_escape_string($db,$_POST['tools5']);

        if($var==="Other")
        {
          if(!isset($_SESSION['profession'][5]) || $_SESSION['profession'][5]!=="Other")
          {
            $_SESSION['profession'][5]=$var;
            $_SESSION['tools'][5]=$tools;
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();
          }
          else
          {
            if(empty($_POST['other5']))
            {
              echo '<script>alert("Write name of profession!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die();
            }
            $oth=mysqli_real_escape_string($db,$_POST['other5']);
            if(isset($_SESSION['other']) && in_array($oth, $_SESSION['other']))
            {
              echo '<script>alert("You have already written this profession as other!!")</script>';
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $q="SELECT * FROM professions where professions='$oth'";
            $r=mysqli_query($db,$q);
            $no=mysqli_num_rows($r);
            if($no==1)
            {
              echo '<script>alert("We have this profession!! Please Select from the list!!")</script>';
              unset($_SESSION['profession'][5]);
              echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
              die(); 
            }
            $_SESSION['other'][5]=$oth;
          }
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        $q="SELECT * FROM professions where professions='$var'";
        $r=mysqli_query($db,$q);
        $no=mysqli_num_rows($r);
        if($no==0)
        {
          echo '<script>alert("There are no such professions registered!! You may choose \"Other\" option and suggest professions which will be later approved by team servico")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
        else
        {
          if(isset($_SESSION['profession']) && in_array($var, $_SESSION['profession']))
          {
            echo '<script>alert("You have already selected \"'.$var.'\" as profession")</script>';
            echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
            die();  
          }
          if(isset($_SESSION['profession'][5]) && $_SESSION['profession'][5]==="Other")
            unset($_SESSION['other'][5]);
          $_SESSION['profession'][5]=$var;
          $_SESSION['tools'][5]=$tools;
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
        }
    }

  

    if(isset($_POST['add']))
    {
      if($count==5)
      {
        echo '<script>alert("You can add only 5 professions at a time!")</script>';
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();  
      }

      for($j=1;$j<=$count;$j++)
      {
        if(!isset($_SESSION['profession'][$j]) || !isset($_SESSION['tools'][$j]))
        {
          echo '<script>alert("First fill profession and tools'.$j.' then click SELECT button then click ADD for adding more professions '.($j+1).'")</script>';
          echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
          die();
        }
      }
      $count++;
      $_SESSION['count']=$count;
      echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
    }

    if(isset($_POST['X']))
    { 
      if($count>1)
      {
        if(isset($_SESSION['profession'][$count]))
        {
          if($_SESSION['profession'][$count]==="Other")
            unset($_SESSION['other'][$count]);
          unset($_SESSION['profession'][$count]);
          unset($_SESSION['tools'][$count]);
        }
        $count--;
      }
      $_SESSION['count']=$count;
      echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
    }

    
  ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" align="center" enctype="multipart/form-data" onsubmit="return passwordval()">
    Personal details:<br><br>
    Name:&nbsp;<input type="text" name="name" placeholder="Enter your name"><br><br>
    Photo:&nbsp;<input type="file" name="image"><br><br>
    Mobile:&nbsp;<input type="text" name="phone" placeholder="Enter your mobile number"><br><br>
    Email:&nbsp;<input type="text" name="email" placeholder="abc@gmail.com"><br><br>
    Address:<br><textarea rows="5" cols="40" wrap="physical" name="address" placeholder="Enter your address"></textarea><br><br>
    Username:&nbsp;<input type="text" name="uname" placeholder="Create your username"><br><br>
    Password: <input type="password" name="pass" placeholder="Create your password" id="pass"><br><br>
    Retype Password: <input type="password" name="repass" placeholder="Create your password" id="repass"><br><span id="messages" style="color:red;"></span><br><br>
    <b>Note:&nbsp;&nbsp;Password must contain at least one number, one uppercase letter, one lowercase letter and at least 8 characters in total</b><br><br>
    <button type="submit" name="sub">Submit</button><br><br>
  </form>
  </fieldset>
  <?php
    if(isset($_POST['sub']))
    {

      if(!isset($_SESSION['country']))
      {
          echo '<script>alert("Please Enter Country!")</script>';
          die();
      }

      if(!isset($_SESSION['state']))
      {
          echo '<script>alert("Please Enter State!")</script>';
          die();
      }

      if(!isset($_SESSION['district']))
      {
          echo '<script>alert("Please Enter District!")</script>';
          die();
      }

      if(!isset($_SESSION['area']))
      {
          echo '<script>alert("Please Enter Area!")</script>';
          die();
      }

      if(!isset($_SESSION['profession']))
      {
          echo '<script>alert("Please Enter Professions!")</script>';
          die();
      }

      if(!isset($_SESSION['tools']))
      {
          echo '<script>alert("Please Enter Tools")</script>';
          die();
      }

        if(empty($_POST['name']))
        {
          echo '<script>alert("Please Enter Name")</script>';
          die();
        }
        else
        {
          $name=mysqli_real_escape_string($db, $_POST['name']);
          $_SESSION['name']=$name;
        }

        if(empty($_FILES['image']['tmp_name']))
        {
          echo '<script>alert("PLEASE UPLOAD YOUR PHOTO")</script>';
          die();
        }
        else
        {
          $image = addslashes($_FILES['image']['tmp_name']);
          $image = file_get_contents($image);
          $image = base64_encode($image);
          $_SESSION['image']=$image;
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
            $mobile=mysqli_real_escape_string($db, $_POST['phone']);
            $_SESSION['phone']=$mobile;
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
            $email=mysqli_real_escape_string($db, $_POST['email']);
            $_SESSION['email']=$email;
          }
        }

        if(empty($_POST['address']))
        {
          echo '<script>alert("Please Enter Address(We will not disclose in public)")</script>';
          die();  
        }
        else
        {
          $address=mysqli_real_escape_string($db, $_POST['address']);
          $_SESSION['address']=$address;
        }

        if(empty($_POST['uname']))
        {
          echo '<script>alert("Please Enter Username")</script>';
          die();
        }
        else
        {
          $username=mysqli_real_escape_string($db,$_POST['uname']);
          $sql="SELECT * FROM pendingregistrations WHERE username='$username'";
          $sql1="SELECT * FROM servicoworkers WHERE username='$username'";
          $result=mysqli_query($db,$sql);
          $result1=mysqli_query($db,$sql1);
          if(mysqli_num_rows($result)>0)
          { 
            echo '<script>alert("Username already exists")</script>';
            die();
          }
          if(mysqli_num_rows($result1)>0)
          { 
            echo '<script>alert("Username already exists")</script>';
            die();
          }
          $_SESSION['uname']=$username;
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
              $pass=password_hash($_POST['pass'],PASSWORD_BCRYPT);
              $_SESSION['pass']=$password;
            }
        }

        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("workerdetailsconfirm.php"); }, 1);</script>';

    }

    if(isset($_POST['desh']))
    {
      if(empty($_POST['country']))
      {
        echo '<script>alert("Choose a Country")</script>';
        die();
      }
      $country=mysqli_real_escape_string($db,$_POST['country']);
      $q1="SELECT * FROM workingcountry where country='$country'";
      $run=mysqli_query($db,$q1);
      $n=mysqli_num_rows($run);
      if($n==0)
      {
        echo '<script>alert("We are not yet established in '.$country.' country")</script>';
        die();
      }
      else
      {
        $_SESSION['country']=$country;
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
      }
    }

    if(isset($_POST['rajya']))
    {
      if(empty($_POST['state']))
      {
        echo '<script>alert("Choose a State")</script>';
        die();
      }
      $state=mysqli_real_escape_string($db,$_POST['state']);
      $country=$_SESSION['country'];
      $q1="SELECT * FROM workingstate where state='$state' and country='$country'";
      $run=mysqli_query($db,$q1);
      $n=mysqli_num_rows($run);
      if($n==0)
      {
        echo '<script>alert("We are not yet established in '.$state.' state")</script>';
        die();
      }
      else
      {
        $_SESSION['state']=$state;
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
      }
    }

    if(isset($_POST['zilla']))
    {
      if(empty($_POST['district']))
      {
        echo '<script>alert("Choose a District")</script>';
        die();
      }
      $district=mysqli_real_escape_string($db,$_POST['district']);
      $state=$_SESSION['state'];
      $q1="SELECT * FROM workingdistrict where district='$district' and state='$state'";
      $run=mysqli_query($db,$q1);
      $n=mysqli_num_rows($run);
      if($n==0)
      {
        echo '<script>alert("We are not yet established in '.$district.' district")</script>';
        die();
      }
      else
      {
        $_SESSION['district']=$district;
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
      }
    }

    if(isset($_POST['ilaka']))
    {
      if(empty($_POST['area']))
      {
        echo '<script>alert("Choose an Area")</script>';
        die();
      }
      $area=mysqli_real_escape_string($db,$_POST['area']);
      $district=$_SESSION['district'];
      $q1="SELECT * FROM workingarea where area='$area' and district='$district'";
      $run=mysqli_query($db,$q1);
      $n=mysqli_num_rows($run);
      if($n==0)
      {
        echo '<script>alert("We are not yet established in '.$area.' area")</script>';
        die();
      }
      else
      {
        $_SESSION['area']=$area;
        echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("employeeregister.php"); }, 1);</script>';
      }
    }
  ?>
</body>
</html>