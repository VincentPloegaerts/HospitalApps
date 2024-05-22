<?php
require_once '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = pdo_connect();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: user_space.php');
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}
?>
<form method="post" action="login.php">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Mot de passe">
    <input type="submit" value="Se connecter">
    <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
</form>
