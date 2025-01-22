<?php
    //Definiujemy dane logowania
    $poprawny_login = "admin";
    $poprawne_haslo = "test";

    $blad = "";

    //Sprawdzanie czy formularz zostal wysłany
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Pobieramy dane z formularza
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        if ($login === $poprawny_login && $haslo === $poprawne_haslo) {
            //Jeżeli dane są poprawne wyświetli komunikat
            echo "<b>Logowanie powiodło się</b>";
        } else {
            //Jeżeli dane są niepoprawne wyświetla komunikat o błędzie
            $blad = "Niepoprawny login lub hasło";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel logowania</title>
</head>
<body>
    <h1>Logowanie</h1>
    <!-- Formularz -->
    <form action="index.php" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" ><br>

        <label for="password">Hasło:</label>
        <input type="password" id="haslo" name="haslo" ><br>

        <button type="submit">Zaloguj się</button>
    </form>
    <?php
    // Sprawdzenie czy jest jakiś komunikat o błędzie
    if ($blad != "") {
        echo "<p style='color: red;'>$blad</p>";
    }
    ?>
</body>
</html>
