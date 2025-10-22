<?php
session_start();

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
    $captcha = $_POST['captcha'];

    $sql = "SELECT * FROM user WHERE login = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1 && $captcha == 8 ) {
        header("Location: _dashboard_db.php");
        exit();
    } else {
        echo "Nieprawidłowy login lub hasło.";
    }

    $stmt->close();
}

$conn->close();
?>
<center>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
      <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; padding: 2rem; background: #f6f7fb; }
    .card { max-width: 520px; margin: 0 auto; background: #fff; padding: 1.5rem; border-radius: 14px; box-shadow: 0 6px 30px rgba(0,0,0,.08); }
    .row { display: flex; gap: 1rem; }
    .row > div { flex: 1; }
    label { display:block; font-weight:600; margin:.25rem 0; }
    input { width:75%; padding:.7rem .9rem; border:1px solid #d5d9e0; border-radius:10px; }
    button { padding:.8rem 1.1rem; border:0; border-radius:10px; background:#2f6feb; color:#fff; font-weight:700; cursor:pointer; }
    .errors { background:#ffe9e9; border:1px solid #ffb4b4; color:#8c1a1a; padding:.8rem; border-radius:10px; margin-bottom:1rem; }
    .ok { background:#e9ffef; border:1px solid #b4ffcb; color:#0c5c2a; padding:.8rem; border-radius:10px; margin-bottom:1rem; }
    small.muted { color:#667085; }
  </style>
</head>
<body>
    <h1>Logowanie</h1>
    <center>
    <form method="POST" action="_login_db.php">
        <label for="login">Nazwa użytkownika</label><br>
        <input type="text" name="login" id="login" required><br><br>

        <label for="pass">Hasło</label><br>
        <input type="password" name="pass" id="pass" required><br><br>

        <label for="captcha">Ile to 5 + 3?</label><br>
        <input type="text" id="captcha" name="captcha" required><br><br>

        <input type="submit" name="submit" value="Zaloguj">
    </form>

    <p>Nie masz konta? <a href="_register_db.php">Zarejestruj się</a></p>
    </center>
</body>
</html>
