<?php
session_start();
require_once 'proces.php';
if (isconnected()) {
    header("Location: dashboard.php");
    exit();
}

try {
    
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
} catch (\Throwable $th) {
    file_put_contents("log",$error,FILE_APPEND);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Se registrer</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenue</h1>
        <h2>Se registrer</h2>
        <form action="" method="post">

            <div>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username"required><br>
            </div>

            <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" required><br>
            </div>
            
            <div>
            <label for="mot de passe">Mot de passe</label><br>
            <input type="password" name="password" id="password" required><br>
            </div>
            
            <div>
                <button tipe="submit">LOG IN</button>
            </div>
        
            <a href="index.php"><p>Déjà inscrit ? Connectez-vous</p></a>
        </form>

        <?php if (isset($noacces)) : ?>
            <p class="error"><?= $noacces ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
