<?php
require_once '../conexionbd.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del recurso ambiental en trámite desde la solicitud POST
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Verificar si el ID es válido (mayor que cero)
    if ($id > 0) {
        // Consulta SQL para eliminar el recurso ambiental en trámite por su ID
        $sql = "DELETE FROM RecursoAmbientalEnTramite WHERE id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                // Éxito al eliminar el recurso
                $response['success'] = true;
                $response['message'] = "Recurso ambiental en trámite eliminado con éxito.";
            } else {
                // Error al eliminar el recurso
                $response['success'] = false;
                $response['message'] = "Error al eliminar el recurso ambiental en trámite: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            $response['success'] = false;
            $response['message'] = "Error en la preparación de la consulta.";
        }
    } else {
        // ID no válido
        $response['success'] = false;
        $response['message'] = "ID de recurso ambiental en trámite vacío o no válido.";
    }
} else {
    // Método no válido para esta solicitud
    $response['success'] = false;
    $response['message'] = "Método no válido para esta solicitud.";
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

