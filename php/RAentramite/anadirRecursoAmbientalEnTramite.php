<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = trim($_POST['numero']);
    $nombre = trim($_POST['nombre']);
    $causa = trim($_POST['causa']);
    $descripcion = trim($_POST['descripcion']);
    $fecha_apertura = trim($_POST['fecha_apertura']);
    $region = trim($_POST['region']);
    $comuna = trim($_POST['comuna']);

    $sql = "INSERT INTO RecursoAmbientalEnTramite (numero, nombre, causa, descripcion, fecha_apertura, region, comuna) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $numero, $nombre, $causa, $descripcion, $fecha_apertura, $region, $comuna);
        
        if ($stmt->execute()) {
            echo "Nuevo recurso ambiental en trámite añadido con éxito.";
        } else {
            echo "Error al añadir el recurso ambiental en trámite: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
