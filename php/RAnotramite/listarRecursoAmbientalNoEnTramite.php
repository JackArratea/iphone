<?php
require_once '../conexionbd.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Realiza la consulta SQL para obtener los recursos ambientales no en trámite
    $sql = "SELECT * FROM RecursoAmbientalNoEnTramite";
    $result = $conn->query($sql);

    if ($result) {
        $recursos = array();

        while ($row = $result->fetch_assoc()) {
            // Agrega cada recurso ambiental a la lista
            $recursos[] = $row;
        }

        $response['success'] = true;
        $response['recursos'] = $recursos;
    } else {
        $response['success'] = false;
        $response['message'] = "Error al obtener los recursos ambientales no en trámite: " . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método no válido para esta solicitud.";
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

