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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f6f7fb; 
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        }
        .login-card {
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem;
            background: #000000ff;
            border-radius: 1rem;
            box-shadow: 0 6px 30px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
<div class="login-card">
        <h2 class="text-center mb-4">Logowanie</h2>
        <form method="POST" action="_login_db.php">
            <div class="mb-3">
                <label for="login" class="form-label">Nazwa użytkownika</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Hasło</label>
                <input type="password" name="pass" id="pass" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="captcha" class="form-label">Ile to 3 + 5?</label>
                <input type="text" name="captcha" id="captcha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
        </form>

        <div class="text-center mt-3">
            <small>Nie masz konta? <a href="_register_db.php">Zarejestruj się</a></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
