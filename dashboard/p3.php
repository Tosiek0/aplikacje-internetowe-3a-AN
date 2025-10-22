<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Calc w PHP</title>
</head>

<body>

    <h3>Oblicz sumę dwóch liczb</h3>

    <form id="sumaForm" method="post" action="">
        <input type="number" name="liczba1" placeholder="Pierwsza liczba" id="liczba1" required>
        <input type="number" name="liczba2" placeholder="Druga liczba" id="liczba2" required>
        <button type="submit" name="suma">Oblicz sumę</button>
        <button type="submit" name="roznica">Oblicz roznice</button>
        <button type="submit" name="mnozenie">Pomnoz</button>
        <button type="submit" name="dzielenie">Podziel</button>
    </form>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $liczba1 = (float)$_POST['liczba1'];
        $liczba2 = (float)$_POST['liczba2'];
        if (!is_numeric($liczba1) || !is_numeric($liczba2)) {
            echo "<p style='color:red;'>Proszę wprowadzić poprawne liczby.</p>";
            exit;
        }

        if (isset($_POST['suma'])) {
            $wynik = $liczba1 + $liczba2;
            echo "<p>Suma: <strong>{$wynik}</strong></p>";
        } elseif (isset($_POST['roznica'])) {
            $wynik = $liczba1 - $liczba2;
            echo "<p>Różnica: <strong>{$wynik}</strong></p>";
        } elseif (isset($_POST['mnozenie'])) {
            $wynik = $liczba1 * $liczba2;
            echo "<p>Mnozenie: <strong>{$wynik}</strong></p>";
        } elseif (isset($_POST['dzielenie'])) {
            $wynik = $liczba1 / $liczba2;
            echo "<p>Dzielenie: <strong>{$wynik}</strong></p>";
        }

    }
    ?>

</body>

</html>