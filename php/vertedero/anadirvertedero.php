<?php
require_once '../conexionbd.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $fecha_apertura = trim($_POST['fecha_apertura']);

    // Validación de datos
    if (empty($nombre) || empty($fecha_apertura)) {
        $response['success'] = false;
        $response['message'] = "Los campos nombre y fecha de apertura son obligatorios.";
    } elseif (strlen($nombre) > 255) {
        $response['success'] = false;
        $response['message'] = "El campo nombre es demasiado largo.";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha_apertura)) {
        $response['success'] = false;
        $response['message'] = "El formato de la fecha de apertura no es válido (debe ser YYYY-MM-DD).";
    } else {
        // Abre la conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            $response['success'] = false;
            $response['message'] = "La conexión a la base de datos falló: " . $conn->connect_error;
        } else {
            $sql = "INSERT INTO Vertedero (nombre, fecha_apertura) VALUES (?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $nombre, $fecha_apertura);
                
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Nuevo vertedero añadido con éxito.";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error al añadir el vertedero: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $response['success'] = false;
                $response['message'] = "Error en la preparación de la consulta.";
            }
            // Cierra la conexión a la base de datos
            $conn->close();
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método no válido para esta solicitud.";
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>




