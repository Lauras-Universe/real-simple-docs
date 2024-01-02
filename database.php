<?php
// Sicherheitsmaßnahmen
defined('ACCESS') or die('No direct script access allowed');
$pdo = new PDO('mysql:host=localhost;dbname=docs_test;charset=utf8', 'root', 'Selina95');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>