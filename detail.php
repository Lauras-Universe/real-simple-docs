<?php
require 'database.php';
require 'vendor/autoload.php';

$id = $_GET['id'];

// SQL to fetch the specific document
$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$id]);
$document = $stmt->fetch();
$Parsedown = new Parsedown();

include_once 'header.php';
?>
    <h1><?= htmlspecialchars($document['title']) ?></h1>
    <div><?= $Parsedown->text($document['content']) ?></div>

<?php
include_once 'footer.php';
