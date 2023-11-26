<?php
require_once '../conexionbd.php'; // Asegúrate de que la ruta sea correcta.

$sql = "SELECT DISTINCT proyecto_nombre FROM socios_proyectos";
$resultado = $conn->query($sql);

$proyectos = [];
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        array_push($proyectos, $fila['proyecto_nombre']);
    }
    echo json_encode($proyectos);
} else {
    echo "[]"; // Devuelve un arreglo vacío en caso de error.
}

$conn->close();
?>

