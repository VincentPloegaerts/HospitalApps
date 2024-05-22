<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $motif = $_POST['motif'];
    $specialite = $_POST['specialite'];
    $medecin = $_POST['medecin'];

    $pdo = pdo_connect();
    $stmt = $pdo->prepare('INSERT INTO sejours (user_id, date_debut, date_fin, motif, specialite, medecin) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $date_debut, $date_fin, $motif, $specialite, $medecin]);

    header('Location: user_space.php');
}
?>
<form method="post" action="create_sejour.php">
    <input type="date" name="date_debut" required>
    <input type="date" name="date_fin" required>
    <input type="text" name="motif" required placeholder="Motif">
    <input type="text" name="specialite" required placeholder="Spécialité">
    <input type="text" name="medecin" required placeholder="Médecin">
    <input type="submit" value="Confirmer">
</form>
