<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $tipo_generacion = isset($_POST['tipo_generacion']) ? trim($_POST['tipo_generacion']) : '';


    $sql = "INSERT INTO CentralElectrica (nombre, tipo_generacion) VALUES (?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $nombre, $tipo_generacion);
        
        if ($stmt->execute()) {
            echo "Nueva central eléctrica añadida con éxito.";
        } else {
            echo "Error al añadir la central eléctrica: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
