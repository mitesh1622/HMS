<?php
	session_start();
	unset ($_SESSION['username']);
	session_destroy();
	echo "<script>window.open('home.php','_self');</script>";
?>
