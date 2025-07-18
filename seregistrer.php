<?php
if(!isset($_POST["utilisateur"]) && !isset($_POST["password"])){
    // header("Location")
    exit();
    
}
$utilisateur =$_POST["utilisateur"];
$motdepasse =$_POST["password"];

$option=["cost"=>12];

$password_hash = password_hash($motdepasse, PASSWORD_BCRYPT, $option);

$hostdb="127.0.0.1";
$usuariobd="root";
$contrabd="root";
$nombrebd="app-database";

$connexion=mysqli_connect($hostdb,$usuariobd,$contrabd,$nombrebd);

if ($connexion->connect_error) {
    die("Conexión fallida: " . $connexion->connect_error);
}

$sql = "INSERT INTO users (utilisateur, password) VALUES (?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("ss", $utilisateur, $password_hash); 

if ($stmt->execute()) {
    echo "¡Registro exitoso!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connexion->close();

?>


