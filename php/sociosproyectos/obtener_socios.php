<?php
require_once '../conexionbd.php'; // Asegúrate de que la ruta al archivo de conexión es correcta.

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Consulta para obtener los nombres de los proyectos
$sql = "SELECT DISTINCT proyecto_nombre FROM socios_proyectos";
$result = $conn->query($sql);

$proyectos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $proyectos[] = $row['proyecto_nombre'];
    }
} else {
    // Enviar una respuesta si no hay proyectos
    $proyectos[] = "No hay proyectos disponibles";
}

// Cierra la conexión a la base de datos
$conn->close();

// Devuelve los datos como respuesta JSON
header('Content-Type: application/json');
echo json_encode($proyectos);
?>



