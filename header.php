<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Document</title>
    <?php
    if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') {
        // Fügen Sie hier spezifische Styles/Scripts für die Startseite hinzu
        echo '<link rel="stylesheet" href="simplemde/simplemde.min.css">';
        echo '<script src="simplemde/simplemde.min.js"></script>';
    }
    ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once 'nav.php'; ?>
