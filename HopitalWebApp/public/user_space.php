<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pdo = pdo_connect();
$stmt = $pdo->prepare('SELECT * FROM sejours WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$sejours = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h1>Votre Espace</h1>
<ul>
    <?php foreach ($sejours as $sejour): ?>
        <li><?php echo $sejour['date_debut'] . ' - ' . $sejour['date_fin'] . ' : ' . $sejour['motif']; ?></li>
    <?php endforeach; ?>
</ul>
