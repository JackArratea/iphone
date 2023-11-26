<?php
require_once '../conexionbd.php';

$sql = "SELECT nombre, apellido, nacionalidad FROM Socio";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row['nombre'] . " - Apellido: " . $row['apellido'] . " - Nacionalidad: " . $row['nacionalidad'] . "<br>";
    }
    $result->free();
} else {
    echo "Error al listar socios: " . $conn->error;
}

$conn->close();
?>
