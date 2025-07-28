<?php 
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
    <form action="proces.php" method="post">
        <input type="hidden" name="registre" value="registre">
        
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username"required><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required><br>
        
        <label for="mot de passe">Mot de passe</label><br>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="Se registrer">
    </form>
<a href="index.php"><p>Déjà inscrit ? Connectez-vous</p></a>
</body>
</html>