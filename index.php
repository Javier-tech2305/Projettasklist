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

    try {
        $user = userExists($username);

        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            $noident = "Identifiants incorrects.";
        }
    } catch (\Throwable $th) {
        // throw $th;
        file_put_contents("log", $error, FILE_APPEND);
    }
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
    <title>LOG IN</title>
</head>

<body>
    
    <div class="container">
    <h1>Bienvenue</h1>
    <h2>LOG IN</h2>
    
    <form action="" method="post">
        
        <div>
            <label for="username">Nom d'utilisateur</label><br>
            <input class="barre" type="text" name="username" id="username" required>
        </div>

        <div>
            <label for="mot de passe">Mot de passe</label><br>
            <input class="barre" type="password" name="password" id="password" required><br>
        </div>

        <div>
            <button tipe="submit">LOG IN</button>
        </div>

    </form>

    <?php if (isset($noident)) : ?>
        <p class="error"><?= $noident ?></p>
    <?php endif; ?>
    <p>
        <a href="registre.php">Se registrer</a>
    </p>
        </div>
</body>

</html>
