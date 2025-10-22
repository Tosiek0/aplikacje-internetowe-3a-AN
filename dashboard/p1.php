<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Sumowanie dwóch pól w PHP</title>
</head>
<body>

<h3>Oblicz sumę dwóch liczb</h3>

<form method="post">
    <input type="number" name="liczba1" placeholder="Pierwsza liczba" id="liczba1" required>
    <input type="number" name="liczba2" placeholder="Druga liczba" id="liczba2" required>
    <button type="submit">Oblicz sumę</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $liczba1 = (float)$_POST['liczba1'];
    $liczba2 = (float)$_POST['liczba2'];
    $suma = $liczba1 + $liczba2;

    echo "<p>Suma: <strong>{$suma}</strong></p>";
}
?>

</body>
</html>