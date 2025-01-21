<?php
// Przykład zapisu zaszyfrowanego hasła w bazie danych

// Dane użytkownika
$username = "admin";
$password = "test";  // Hasło które chcemy zaszyfrować

// Zastosowanie funkcji password_hash() do zaszyfrowania hasła
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Przygotowanie zapytania SQL do zapisania hasła w bazie danych
$query = "INSERT INTO users (username, password) VALUES (?, ?)";

// Przygotowanie zapytania w bazie danych
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();

// Zamknięcie połączenia
$stmt->close();
?>
