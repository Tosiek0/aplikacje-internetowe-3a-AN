<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Witaj!</title>
</head>
<body>
	<p>Zostałeś zalogowany</p>
	<p><a href="logout.php">Wyloguj mnie</a></p>
</body>
</html>