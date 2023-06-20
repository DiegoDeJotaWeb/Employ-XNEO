<?php
	$host = "localhost";
	$user = "php_mysql";
	$pass = "12345";
	$db   = "contatos";
	
	$conn = mysqli_connect($host, $user, $pass, $db)or die (mysqli_error());
?>