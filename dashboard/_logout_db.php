<?php
session_start();
session_destroy();
header("Location: _login_db.php");
exit();
?>