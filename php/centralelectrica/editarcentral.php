<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_original = trim($_POST['nombre_original']);
    $nombre = trim($_POST['nombre']);
    $tipo_generacion = trim($_POST['tipo_generacion']);

    $sql = "UPDATE CentralElectrica SET nombre = ?, tipo_generacion = ? WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $nombre, $tipo_generacion, $nombre_original);
        
        if ($stmt->execute()) {
            echo "Central eléctrica actualizada con éxito.";
        } else {
            echo "Error al actualizar la central eléctrica: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
