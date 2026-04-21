<?php
session_start(); // Nutné pro zapamatování přihlášení
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['jmeno'];
    $pass = $_POST['pass'];

    // 1. Najdeme uživatele podle jména
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM `eshop-accounts` WHERE username = ?");
    $stmt->execute([$user]);
    $account = $stmt->fetch();

    // 2. Ověříme heslo
    if ($account && password_verify($pass, $account['password_hash'])) {
        // Heslo je správné! Nastavíme session
        $_SESSION['user_id'] = $account['id'];
        $_SESSION['username'] = $account['username'];
        
        echo "Přihlášení úspěšné! Vítejte, " . htmlspecialchars($account['username']) . ".";
        echo "<br><a href='index.html'>Pokračovat na hlavní stránku</a>";
    } else {
        // Špatné jméno nebo heslo
        echo "Neplatné uživatelské jméno nebo heslo. <a href='prihlaseni.html'>Zkusit znovu</a>";
    }
}
?>