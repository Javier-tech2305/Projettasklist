<?php
session_start();
require_once 'proces.php';
if (!isconnected()) {

    header("Location: index.php");
    exit();
}

if(isset($_POST['title']) && isset($_POST['description']) && isset($_SESSION['id'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['id'];

    try {

        createtache($title, $description, $user_id);
        header("Location: dashboard.php");
        exit();

    } catch (PDOException $e) {
        
        echo "". $e->getMessage() ."";

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
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Gestionnaire des tâches</h1>
            <p>Organisez et gérez vos tâches quotidiennes</p>
            <h2>A faire</h2>
        </header>
        
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Descriptión</th>
                    <th>Status</th>
                    <th>Date de Creation</th>
                    <th>Terminée à</th>
                    <th>Action</th>   
                </tr>
            </thead>
            
            <?php if (isset($_SESSION['id'])) :?>
            <?php $tasks = getTasksByUserId($_SESSION['id']); ?>
            <?php if ($tasks) : ?>
            <?php foreach ($tasks as $task) : ?>
                                
            <tbody>
                <tr>
                    <td><?= $task['title'] ?></td>
                    <td><?= $task['description'] ?></td>
                    <?php if ($task['status'] == 0) : ?>
                    <td>En cours</td>
                    <?php else : ?>
                    <td>Terminée</td>
                    <?php endif; ?>
                    <td><?= $task['create_at'] ?></td>
                    <td><?= $task['termine_at'] ?></td>
                    <td><a href="proces.php?id=<?= $task['id']?>&status=1"><button>Terminé</button></a> | <a href="proces.php?id=<?= $task['id']?>&borrar=borrar"><button>supprimer</button></a></td>
                </tr>
                                        
                <?php endforeach; ?>
                <?php else : ?>
                <td><strong>Aucune tâche trouvée.</strong></td>
                <?php endif; ?>
                <?php endif; ?>    
                                            
            </tbody>
        </table>
        
        <h3>Créer une nouvelle tâche</h3>
        <form action="" method="post">
            
            <label for="title">Títre:</label>
            <input type="text" id="title" name="title" required placeholder="Nouvelle tâche">
                    
            <label for="description">Description:</label>
            <textarea id="description" name="description" required placeholder="Description"></textarea>
                    
            <button type="submit">Créer</button>

        </form>
            
            <p><a href="logout.php">Se déconnecter</a></p>
        
        <footer>
            <p>TaskList <em>All right reserved</em> Javier Archila Rojas</p>
        </footer>
    </div>
</body>
</html>

    

