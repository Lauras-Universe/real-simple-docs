<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eingabeübernahme
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_password = $_POST['db_password'];

    $admin_user = $_POST['admin_user'];
    $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);

    // Erstellen der database.php Datei
    $db_config = "<?php\n";
    $db_config .= "// Sicherheitsmaßnahmen\n";
    $db_config .= "defined('ACCESS') or die('No direct script access allowed');\n";
    $db_config .= "\$pdo = new PDO('mysql:host=$db_host;dbname=$db_name;charset=utf8', '$db_user', '$db_password');\n";
    $db_config .= "\$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
    $db_config .= "\$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);\n";
    $db_config .= "?>";

    file_put_contents('database.php', $db_config);

    try {
        // Verbindung zur Datenbank und Tabellenerstellung
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL-Befehle zum Erstellen der Tabellen
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $pdo->exec("CREATE TABLE IF NOT EXISTS documents (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            category_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )");

        // Erstellen des Admin-Accounts
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$admin_user, $admin_password]);

        // Setzen der Berechtigungen für database.php
        chmod('database.php', 0600);

        // Löschen der install.php-Datei
        unlink(__FILE__);

        echo "Installation erfolgreich!";

    } catch (PDOException $e) {
        die("Datenbankfehler: " . $e->getMessage());
    }
} else {
    // Formular anzeigen
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Docs-System Installation</title>
    </head>
    <body>
        <h1>Installation des Docs-Systems</h1>
        <form action="install.php" method="post">
            <h2>Datenbank-Einstellungen</h2>
            <p><label>DB-Host:</label><input type="text" name="db_host" required></p>
            <p><label>DB-Name:</label><input type="text" name="db_name" required></p>
            <p><label>DB-Benutzer:</label><input type="text" name="db_user" required></p>
            <p><label>DB-Passwort:</label><input type="password" name="db_password"></p>
            <h2>Admin-Account erstellen</h2>
            <p><label>Benutzername:</label><input type="text" name="admin_user" required></p>
            <p><label>Passwort:</label><input type="password" name="admin_password" required></p>
            <button type="submit">Installieren</button>
        </form>
    </body>
    </html>
    <?php
}
?>
