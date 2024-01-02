<?php
define('ACCESS', true);
require 'database.php';

session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Passwort ist korrekt
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    } else {
        $message = 'Falscher Benutzername oder Passwort';
    }
}
include_once 'header.php';
?>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="password" name="password" placeholder="Passwort" required>
    <button type="submit">Login</button>
</form>

<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>
<?php

include_once 'footer.php';