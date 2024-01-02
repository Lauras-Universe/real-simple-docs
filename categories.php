<?php
define('ACCESS', true);
require 'database.php';

$stmt = $pdo->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll();

include_once 'header.php';

?>
<h1>Kategorien</h1>
<ul>
<?php foreach ($categories as $category): ?>
    <li>
        <a href="list.php?category_id=<?= $category['id'] ?>">
            <?= htmlspecialchars($category['name']) ?>
        </a>

    </li>
<?php endforeach; ?>
</ul>
<?php

include_once 'footer.php';