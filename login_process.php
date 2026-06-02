<?php
session_start();
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['jmeno'];
    $pass = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM `eshop-accounts` WHERE username = ?");
    $stmt->execute([$user]);
    $account = $stmt->fetch();

    if ($account && password_verify($pass, $account['password_hash'])) {
        $_SESSION['user_id'] = $account['id'];
        $_SESSION['username'] = $account['username'];
        
        echo "Přihlášení úspěšné! Vítejte, " . htmlspecialchars($account['username']) . ".";
        echo "<br><a href='index.html'>Pokračovat na hlavní stránku</a>";
    } else {
        echo "Neplatné uživatelské jméno nebo heslo. <a href='prihlaseni.html'>Zkusit znovu</a>";
    }
}
?>
