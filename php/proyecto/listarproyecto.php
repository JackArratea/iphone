<?php
require_once '../conexionbd.php';

$response = []; // Inicializa un arreglo para la respuesta

// Consulta SQL para seleccionar todos los campos de la tabla Proyecto
$sql = "SELECT nombre, latitud, longitud, region, comuna, fecha_apertura, operativa FROM Proyecto";
$result = $conn->query($sql);

if ($result) {
    // Recorre cada fila de resultado como un array asociativo y agrégalo al array de respuesta
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    $result->free(); // Libera el conjunto de resultados
} else {
    // Si hay un error en la consulta SQL, agrega un mensaje de error al arreglo
    $response = ['error' => "Error al listar proyectos: " . $conn->error];
}

$conn->close(); // Cierra la conexión

// Establece el tipo de contenido como JSON y envía la respuesta
header('Content-Type: application/json');
echo json_encode($response);
?>


