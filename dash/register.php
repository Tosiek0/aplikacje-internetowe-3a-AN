<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "log";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = htmlspecialchars($_POST['login']);
    $pass = htmlspecialchars($_POST['pass']);
    $pass_repeat = htmlspecialchars($_POST['pass_repeat']);

    if (strlen($pass) < 8) {
        die("Hasło musi mieć co najmniej 8 znaków.");
    }

    if ($pass !== $pass_repeat) {
        die("Hasła nie są takie same. Spróbuj ponownie.");
    }

    $sql = "INSERT INTO user (login, pass) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $pass); 

    if ($stmt->execute()) {
        header("Location: _registered_db.php"); 
        exit();
    } else {
        echo "Błąd: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Rejestracja</h1>
    <center>
    <form method="POST" action="_register_db.php">
        <label for="login">Nazwa użytkownika</label><br>
        <input type="text" name="login" id="login" required><br><br>

        <label for="pass">Hasło</label><br>
        <input type="password" name="pass" id="pass" minlength="8" required><br><br>

        <label for="pass_repeat">Powtórz hasło</label><br>
        <input type="password" name="pass_repeat" id="pass_repeat" required><br><br>

        <input type="submit" name="submit" value="Zarejestruj">
    </form>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
