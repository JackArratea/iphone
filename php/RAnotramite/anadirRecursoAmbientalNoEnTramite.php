<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = trim($_POST['numero']);
    $nombre = trim($_POST['nombre']); // Asegúrate de que este campo corresponda a una entrada válida en 'Proyecto'
    $fechaDictamen = trim($_POST['fecha_dictamen']);
    $descripcion = trim($_POST['descripcion']);
    $causa = trim($_POST['causa']);
    $fecha_apertura = trim($_POST['fecha_apertura']);
    $region = trim($_POST['region']);
    $comuna = trim($_POST['comuna']);
    $status = trim($_POST['status']);

    $sql = "INSERT INTO RecursoAmbientalNoEnTramite (numero, nombre, fecha_dictamen, descripcion, causa, fecha_apertura, region, comuna, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssss", $numero, $nombre, $fechaDictamen, $descripcion, $causa, $fecha_apertura, $region, $comuna, $status);
        
        if ($stmt->execute()) {
            echo "Nuevo recurso ambiental no en trámite añadido con éxito.";
        } else {
            echo "Error al añadir el recurso ambiental no en trámite: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

