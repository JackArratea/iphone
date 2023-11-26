<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);

    $sql = "DELETE FROM Proyecto WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nombre);
        
        if ($stmt->execute()) {
            echo "Proyecto eliminado con éxito.";
        } else {
            echo "Error al eliminar proyecto: " . $stmt->error;
        }
        $stmt->close();
    }
    
    $conn->close();
}
?>
