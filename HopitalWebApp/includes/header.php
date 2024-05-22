<?php
// Inclure le fichier de fonctions
include_once __DIR__ . '/functions.php';

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoigneMoi</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue à SoigneMoi</h1>
        <?php if (is_logged_in()): ?>
            <nav>
                <ul>
                    <li><a href="user_space.php">Mon espace</a></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                </ul>
            </nav>
        <?php else: ?>
            <nav>
                <ul>
                    <li><a href="register.php">S'inscrire</a></li>
                    <li><a href="login.php">Se connecter</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </header>
