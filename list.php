<?php
define('ACCESS', true);
require 'database.php';

$category_id = $_GET['category_id'] ?? null;

$query = "SELECT documents.id, documents.title, categories.name AS category_name 
          FROM documents 
          LEFT JOIN categories ON documents.category_id = categories.id";

$params = [];
if ($category_id) {
    $query .= " WHERE category_id = ?";
    $params[] = $category_id;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$documents = $stmt->fetchAll();

include_once 'header.php';
?>


    <h1>Dokumentenliste</h1>
    <ul>
    <?php foreach ($documents as $document): ?>
        <?php if ($document['category_name']): 
            echo "<p class='categories'>Kategorie: ". htmlspecialchars($document['category_name']). "</p>";
        endif; ?>
        <li>
            <a href="detail.php?id=<?= $document['id'] ?>">
                <?= htmlspecialchars($document['title']) ?>
            </a>

        </li>
    <?php endforeach; ?>
    </ul>

<?php

include_once 'footer.php';
