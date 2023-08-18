<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image">
    <input type="submit" value="Upload Image" name="submit">
    <input type="submit" value="Show Image" name="sub">
  </form>
<?php
  
  $db = mysqli_connect('localhost', 'root', '', 'servico');

  if(isset($_POST['submit']))
  {
    if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
    {
      echo '<script>alert("PLEASE UPLOAD IMAGE")</script>';
      echo '<script type="text/javascript">setTimeout(function(){ window.location.replace("samp.php"); }, 1);</script>';
      die();
    }
    $image = addslashes($_FILES['image']['tmp_name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
    $name = addslashes($_FILES['image']['name']);
    $sql = "INSERT INTO samp VALUES ('$image', '$name')";
    mysqli_query($db,$sql);
  }

  if(isset($_POST['sub']))
  {
    $sql = "SELECT image FROM samp";
    $result = mysqli_query($db,$sql);
    while ($row=mysqli_fetch_array($result))
    {
      echo '<img height="400" width="400" src="data:image;base64,'.$row['image'].'">';
    }
  }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Personal details:<br><br>
    Name:&nbsp;<input type="text" name="name" placeholder="Enter your name"><br><br>
    Mobile:&nbsp;<input type="text" name="phone" placeholder="Enter your mobile number"><br><br>
    Email:&nbsp;<input type="text" name="email" placeholder="abc@gmail.com"><br><br>
    Address:<br><textarea rows="5" cols="40" wrap="physical" name="address" placeholder="Enter your address"></textarea><br><br>
    <button type="submit" name="sub">Submit</button><br><br>
  </form>

</body>
</html>