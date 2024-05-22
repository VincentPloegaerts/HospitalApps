<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_input($_POST['name']);
    $surname = sanitize_input($_POST['surname']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $address = sanitize_input($_POST['address']);

    if (!validate_email($email)) {
        $error = "Email non valide";
    } elseif (!validate_password($password)) {
        $error = "Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    } else {
        $pdo = pdo_connect();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "L'email est déjà utilisé.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, surname, email, password, address) VALUES (?, ?, ?, ?, ?)');
            if ($stmt->execute([$name, $surname, $email, $hashed_password, $address])) {
                $_SESSION['user_id'] = $pdo->lastInsertId();
                header('Location: user_space.php');
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
    }
}
?>

<?php include('../includes/header.php'); ?>
<h2>Inscription</h2>
<?php if (isset($error)): ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>
<form action="register.php" method="post">
    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" required>
    <label for="surname">Prénom:</label>
    <input type="text" id="surname" name="surname" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>
    <label for="address">Adresse:</label>
    <input type="text" id="address" name="address" required>
    <input type="submit" value="Inscription">
</form>
<?php include('../includes/footer.php'); ?>
