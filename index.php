<?php
session_start();
require_once 'proces.php'; 
if (isconnected()) {
    header("Location: dashboard.php");
    exit();
} 

if (isset($_POST['username']) && $_POST['password']) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $user=userExists($username);
    
    if ($user['username']===$username && password_verify($password, $user['password'])) {
        $_SESSION = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $noident= "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>LOG IN</title>
</head>
<body>
    <h1>Bienvenue</h1>
    <h2>LOG IN</h2>
    <form action="" method="post">
        
        <label for="username">Nom d'utilisateur</label><br>
        <input type="text" name="username" id="username" required><br>
        
        <label for="mot de passe">Mot de passe</label><br>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="LOG IN">

    </form>
    <?php if (isset($noident)) : ?>
        <p class="error"><?= $noident ?></p>
    <?php endif; ?>
    <a href="registre.php"><P>Se registrer</P></a>
    
</body>
</html>