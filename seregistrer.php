<?php
if(isset($_POST)){

    $utilisateur =$_POST["utilisateur"];
    $motdepasse =$_POST["password"];

}

$option=["cost"=>12];

$password_hash = password_hash($motdepasse, PASSWORD_BCRYPT, $option);

$hostdb="127.0.0.1";
$nombrebd="app-database";
$usuariobd="root";
$contrabd="root";

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

// 6. Cerrar conexiones
$stmt->close();
$conn->close();

?>


