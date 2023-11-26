<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);


    $sql = "DELETE FROM Mina WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nombre);
        
        if ($stmt->execute()) {
            echo "Mina eliminada con éxito.";
        } else {
            echo "Error al eliminar la mina: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
