<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();

redirect_if_not_logged_in();

if ($_SESSION['user_role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$pdo = pdo_connect();
$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include('../includes/header.php'); ?>
<h1>Administration</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['address']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('../includes/footer.php'); ?>
