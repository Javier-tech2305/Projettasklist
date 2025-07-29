<?php
session_start();
require_once 'proces.php';
if (isconnected()) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['username']) && $_POST['password'] && isset($_POST['email'])) {
  
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);

    if (userExists($username)) {
        $noacces="username existe déjà.";
    } else {
        newRegistre($username, $password, $email);
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Se registrer</title>
</head>
<body>
    <h1>Bienvenue</h1>
    <h2>Se registrer</h2>
    <form action="" method="post">
        
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username"required><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required><br>
        
        <label for="mot de passe">Mot de passe</label><br>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="Se registrer">
    </form>

    <?php if (isset($noacces)) : ?>
        <p class="error"><?= $noacces ?></p>
    <?php endif; ?>
<a href="index.php"><p>Déjà inscrit ? Connectez-vous</p></a>
</body>
</html>