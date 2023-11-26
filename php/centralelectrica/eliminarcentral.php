<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);

    // Antes de eliminar, verifica si la central eléctrica está siendo referenciada en otra tabla.

    $sql = "DELETE FROM CentralElectrica WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nombre);
        
        if ($stmt->execute()) {
            echo "Central eléctrica eliminada con éxito.";
        } else {
            echo "Error al eliminar la central eléctrica: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
