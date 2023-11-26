<?php
require_once 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_original = trim($_POST['nombre_original']); // El nombre actual del vertedero
    $nombre_nuevo = trim($_POST['nombre_nuevo']); // El nuevo nombre del vertedero

    // Preparar la consulta SQL
    $sql = "UPDATE Vertedero SET nombre = ? WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Vincular los nuevos valores con la declaración preparada
        $stmt->bind_param("ss", $nombre_nuevo, $nombre_original);
        
        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Vertedero actualizado con éxito.";
        } else {
            echo "Error al actualizar el vertedero: " . $stmt->error;
        }
        // Cerrar la declaración
        $stmt->close();
    }
    // Cerrar la conexión
    $conn->close();
}
?>
