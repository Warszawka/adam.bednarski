<?php
// Przykład sprawdzenia danych logowania

// Dane z formularza logowania zakładając że zostały one przesłane przez formularz
$username_input = $_POST['username'];
$password_input = $_POST['password'];

// Zapytanie do bazy danych, aby znaleźć użytkownika
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username_input);
$stmt->execute();
$result = $stmt->get_result();

// Sprawdzanie czy użytkownik został znaleziony
if ($result->num_rows > 0) {
    // Użytkownik istnieje teraz porównujemy hasło
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];  // Zaszyfrowane hasło z bazy danych

    // Funkcja password_verify() porównuje wprowadzone hasło z zapisanym haszem
    if (password_verify($password_input, $hashed_password)) {
        // Logowanie udane
        echo "Logowanie udane";
    } else {
        // Niepoprawne hasło
        echo "Niepoprawne hasło";
    }
} else {
    // Użytkownik o tym loginie nie istnieje
    echo "Niepoprawny login!";
}

$stmt->close();
?>
