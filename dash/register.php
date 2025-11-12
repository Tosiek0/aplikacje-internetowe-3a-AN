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
        header("Location: registered.php"); 
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
    <link rel="stylesheet" href="css/login_style.css">
</head>
<body>
<div class="login-card">
    <h2 class="text-center mb-4">Rejestracja</h2>
    <form method="POST" action="register.php">
        <div class="mb-3">
            <label for="login" class="form-label">Nazwa użytkownika</label>
            <input type="text" name="login" id="login" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="pass" class="form-label">Hasło</label>
            <input type="password" name="pass" id="pass" class="form-control" minlength="8" required>
        </div>

        <div class="mb-3">
            <label for="pass_repeat" class="form-label">Powtórz hasło</label>
            <input type="password" name="pass_repeat" id="pass_repeat" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Zarejestruj</button>
    </form>

    <div class="text-center mt-3">
        <small>Masz już konto? <a href="login.php">Zaloguj się</a></small>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
