<?php
require_once 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']); // El nombre del vertedero a eliminar

    // Preparar la consulta SQL
    $sql = "DELETE FROM Vertedero WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los valores con la declaración preparada
        $stmt->bind_param("s", $nombre);
        
        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Vertedero eliminado con éxito.";
        } else {
            echo "Error al eliminar el vertedero: " . $stmt->error;
        }
        // Cerrar la declaración
        $stmt->close();
    }
    // Cerrar la conexión
    $conn->close();
}
?>
