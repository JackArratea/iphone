<?php
require_once '../conexionbd.php';

$response = array();

// Realiza la consulta SQL para obtener los registros
$sql = "SELECT id, nombre, fecha_apertura FROM Vertedero";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $vertederos = array();
    while ($row = $result->fetch_assoc()) {
        $vertederos[] = $row;
    }
    $response['success'] = true;
    $response['vertederos'] = $vertederos;
} else {
    $response['success'] = false;
    $response['message'] = "No se encontraron vertederos.";
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

