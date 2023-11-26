<?php
require_once '../conexionbd.php';

// Crear un arreglo para almacenar la respuesta
$minas = array();

$sql = "SELECT id, nombre, mineral FROM Mina"; // Asegúrate de seleccionar el 'id' también
if ($result = $conn->query($sql)) {
    // Recoger todas las filas en un arreglo
    while ($row = $result->fetch_assoc()) {
        $minas[] = $row; // Agregar cada fila al arreglo
    }
    $result->free();
    // Enviar el arreglo como JSON
    header('Content-Type: application/json');
    echo json_encode($minas);
} else {
    // Si hay un error, incluirlo en la respuesta JSON
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Error al listar las minas: " . $conn->error));
}

$conn->close();
?>
