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

    createtache($title, $description, $user_id);
    header("Location: dashboard.php");
    exit();
}

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
    <div class="container">
        <header>
            <h1>Gestionnaire des tâches</h1>
            <p>Organisez et gérez vos tâches quotidiennes</p>
        </header>
        
        <div class="content">
            
            <div class="tasks-section">
                <h2 class="section-title">A faire</h2>
            
                <table class="tasks-table">
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
            </div>
                                        
            <div class="new-task-form">
                <h3 class="form-title">Créer une nouvelle tâche</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Títre:</label>
                        <input type="text" id="title" name="title" required placeholder="Nouvelle tâche">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required placeholder="Description"></textarea>
                    </div>
                    
                    <button type="submit">Créer</button>
                </form>
            </div>
            <p><a href="logout.php">Se déconnecter</a></p>
        </div>
        <footer>
            <p>TaskList <em>All right reserved</em> Javier Archila Rojas</p>
        </footer>
    </div>
</body>
</html>

    

