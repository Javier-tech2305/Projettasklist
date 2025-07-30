<?php
session_start();

function connect() {
    $dsn = "mysql:host=127.0.0.1;dbname=app-database";
    $usuario="root";
    $pas="root";
    $bdd = new pdo($dsn,$usuario,$pas);
    return $bdd;
}

function isconnected() {
    return isset($_SESSION['id']);
}   

function newRegistre($username, $password, $email) {
    $bdd = connect();
    $option=["cost"=>12];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $option);
    
    $sql = "INSERT INTO user(username, password, email) VALUES (?,?,?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$username, $password_hash, $email]);
}

function userExists($username) {
    $bdd = connect();
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createtache($title, $description, $user_id) {
    $date = date('Y-m-d H:i:s');
    $status = 0; 
    $bdd = connect();
    $sql = "INSERT INTO tasks(title, description, user_id, create_at, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$title, $description, $user_id, $date, $status]);
    
}

function getTasksByUserId($user_id) {
    $bdd = connect();
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function deleteTask($task_id) {
    $bdd = connect();
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$task_id]);
}

function updateTaskStatus($task_id, $status) {
    $date = date('Y-m-d H:i:s');
    $bdd = connect();
    $sql = "UPDATE tasks SET status = ?, termine_at = ? WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$status, $date, $task_id]);
}
function verifystatus($task_id) {
    $bdd = connect();
    $sql = "SELECT status FROM tasks WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_GET['id'])&& isset($_GET['borrar'])) {
    $task_id = $_GET['id'];
    deleteTask($task_id);
    header("Location: dashboard.php");
    exit();
}else if((isset($_GET['id']) && isset($_GET['status']))) {
    $task_id = $_GET['id'];
    $status = $_GET['status'];
    $statusactive = verifystatus($task_id);
    if ($statusactive['status'] == 1) {
    
        header("Location: dashboard.php");
        exit();
    
    } else {
        
    updateTaskStatus($task_id, $status);
    header("Location: dashboard.php");
    exit();
}
}




?>


