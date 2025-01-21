<?php
    // Dane do połączenia z bazą
    $host = 'localhost';
    $db = 'login_system';
    $user = 'root';       
    $password = '';

    // Połączenie z bazą danych
    $conn = new mysqli($host, $user, $password, $db);

    // Sprawdzanie połączenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Definiowanie danych logowania
    $poprawny_login = "admin";
    $poprawne_haslo = "test";

    $error_message = "";

    // Sprawdzanie, czy formularz został wysłany
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Pobieramy dane z formularza
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        // Przygotowanie zapytania SQL, aby znaleźć użytkownika o podanym loginie
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $login);  //"s" = zmienna typu string
        $stmt->execute(); // Wykonanie zapytania
        
        $result = $stmt->get_result();

        // Jeśli znaleziono użytkownika
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();  // Pobranie danych użytkownika

            if ($row['password'] === $haslo) {
                // Zalogowano pomyślnie
                $error_message = "<h2>Logowanie udane</h2>";
            } else {
                // Niepoprawne hasło
                $error_message = "Niepoprawne hasło";
            }
        } else {
            // Niepoprawny użytkownik
            $error_message = "Niepoprawny login";
        }

        // Zamknięcie zapytania i połączenia
        $stmt->close();
        $conn->close();
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
        <input type="text" id="login" name="login"><br>

        <label for="password">Hasło:</label>
        <input type="password" id="haslo" name="haslo"><br>

        <button type="submit">Zaloguj się</button>
    </form>
    <?php
    // Sprawdzenie, czy jest jakiś komunikat o błędzie
    if ($error_message != "") {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
</body>
</html>
