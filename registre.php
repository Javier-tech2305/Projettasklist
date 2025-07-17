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
    <form action="seregistrer.php" method="post">

        <label for="utilisateur">Nom d'utilisateur</label><br>
        <input type="text" name="utilisateur" id="utilisateur"required><br>
        <label for="mot de passe">Mot de passe</label><br>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Se registrer">
</body>
</html>