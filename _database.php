
<?php
$host = 'localhost';
$db   = 'docs'; // Ersetzen Sie dies mit Ihrem Datenbanknamen
$user = 'root';     // Ersetzen Sie dies mit Ihrem Datenbankbenutzernamen
$pass = 'Selina95'; // Ersetzen Sie dies mit Ihrem Datenbankpasswort
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
