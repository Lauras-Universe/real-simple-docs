<?php

if (!file_exists('database.php')) {
    header('Location: install.php');
}
define('ACCESS', true);
require 'database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    // Nehmen Sie category_id aus dem POST-Request
    $category_id = $_POST['category_id'];

    // Fügen Sie die Kategorie-ID in Ihre INSERT-Anweisung ein
    $stmt = $pdo->prepare("INSERT INTO documents (title, content, category_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $category_id]);


    $message = 'Dokument gespeichert!';
}

include_once 'header.php';
?>
<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<form action="index.php" method="post">
    <input type="text" name="title" placeholder="Titel" required>
    <select name="category_id">
        <?php
        // Holen Sie die Kategorien aus der Datenbank
        $stmt = $pdo->query("SELECT id, name FROM categories");
        while ($row = $stmt->fetch()) {
            echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['name']) . "</option>";
        }
        ?>
    </select>
    <textarea name="content" id="markdown-editor"></textarea>
    <button type="submit">Dokument speichern</button>
</form>

<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("markdown-editor"),
        toolbar: ["bold", "italic", "heading", "|", "code", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "side-by-side", "fullscreen", "|", "guide"]
    });
</script>


<a href="list.php">Liste der Dokumente anzeigen</a>

<?php

include_once 'footer.php';