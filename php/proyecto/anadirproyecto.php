<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $latitud = trim($_POST['latitud']);
    $longitud = trim($_POST['longitud']);
    $region = trim($_POST['region']);
    $comuna = trim($_POST['comuna']);
    $fecha_apertura = trim($_POST['fecha_apertura']);
    $operativa = trim($_POST['operativa']);

    $sql = "INSERT INTO Proyecto (nombre, latitud, longitud, region, comuna, fecha_apertura, operativa) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sddssss", $nombre, $latitud, $longitud, $region, $comuna, $fecha_apertura, $operativa);
        
        if ($stmt->execute()) {
            echo "Proyecto añadido con éxito.";
        } else {
            echo "Error al añadir proyecto: " . $stmt->error;
        }
        $stmt->close();
    }
    
    $conn->close();
}
?>
