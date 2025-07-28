<?php
session_start();
var_dump($_SESSION);
require_once 'proces.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>         
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenue, <?= $_SESSION['username'] ?? 'Invité' ?></h1>
    <h2>Tableau de bord</h2>
    <p>Vous êtes connecté en tant que <?= $_SESSION['username'] ?? 'Invité' ?></p>
    <h3>Vos tâches</h3>
    <ul>
        <?php if (isset($_SESSION['id'])) :?>
           <?php $tasks = getTasksByUserId($_SESSION['id']); ?>
            <?php if ($tasks) : ?>
                <?php foreach ($tasks as $task) : ?>
                    <li><?= $task['title'] ?> - <?= $task['description'] ?></li>
                <?php endforeach; ?>
            <?php else : ?>
                <li>Aucune tâche trouvée.</li>
            <?php endif ?>
    <p><a href="logout.php">Se déconnecter</a></p>
   
</body>
</html>


