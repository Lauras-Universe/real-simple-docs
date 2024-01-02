<nav>
    <ul>
        <li id="logo"><a href="list.php">Dokumentation von Lauras-Universe & Milawe Media</a></li>
        <?php if (isset($_SESSION['user_id'])) {
            echo '<li><a href="index.php">Eintragen</a></li>';
            echo '<li><a href="logout.php">Ausloggen</a></li>';
        } else {
            echo '<li><a href="login.php">Einloggen</a></li>';
        } ?>
        
        <li><a href="list.php">Liste</a></li>
        <li><a href="categories.php">Categories</a></li>
    </ul>
</nav>