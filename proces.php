<?php
session_start();

function connect() {
    $dsn = "mysql:host=127.0.0.1;dbname=app-database";
    $usuario="root";
    $pas="root";
    $bdd = new pdo($dsn,$usuario,$pas);
    return $bdd;
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
    $bdd = connect();
    $sql = "INSERT INTO tasks(title, description, user_id) VALUES (?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$title, $description, $user_id]);
    
}

function getTasksByUserId($user_id) {
    $bdd = connect();
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




$registre = "registre";
$logIn = "logIn";


if (isset($_POST['registre']) && $_POST['registre'] === $registre) {
        echo "ahora si entro";
    echo " \n";
     echo " \n";    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (userExists($username)) {
        echo "username existe déjà.";
    } else {
        newRegistre($username, $password, $email);
        header("Location: index.php");
        exit();
    }
} elseif (isset($_POST['logIn']) && $_POST['logIn'] === 'logIn') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user=userExists($username);

    var_dump($user);
    
    if ($user['username']===$username && password_verify($password, $user['password'])) {
        $_SESSION = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}



?>


