<?php
session_start();

$usernamea = "login";
$passworda = "123";


if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $usernamea && $password === $passworda) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
}
else{
    $error = "<br>Nieprawidlowa nazwa uzytkownika lub haslo";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    </head>
    <body>
    <h1>skibi</h1>
 <form method="POST" action="login.php">
        <label for="username">Nazwa uzytkownika</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Haslo</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" name="submit" value="Zaloguj">
    </form>   
    <?php
    if(isset($error)) 
    {
        echo $error;
    }
?>
</body>
</html>