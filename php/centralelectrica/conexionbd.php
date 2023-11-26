<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "github";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa";
}

// Cierra la conexión
$conn->close();
?>
