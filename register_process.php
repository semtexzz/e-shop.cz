<?php
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // 1. Hashování hesla (bezpečnost!)
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // 2. Uložení do databáze pomocí Prepared Statements
    $sql = "INSERT INTO `eshop-accounts` (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$user, $email, $hashed_password]);
        echo "Registrace úspěšná! <a href='prihlaseni.html'>Nyní se můžete přihlásit zde.</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Chyba pro duplicitní jméno/email
            echo "Uživatel nebo email již existuje.";
        } else {
            echo "Chyba při registraci: " . $e->getMessage();
        }
    }
}
?>