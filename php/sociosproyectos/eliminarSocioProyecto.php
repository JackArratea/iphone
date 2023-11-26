<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $socio_nombre = trim($_POST['socio_nombre']);
    $socio_apellido = trim($_POST['socio_apellido']);
    $proyecto_nombre = trim($_POST['proyecto_nombre']);

    $sql = "DELETE FROM Socios_Proyectos WHERE socio_nombre = ? AND socio_apellido = ? AND proyecto_nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $socio_nombre, $socio_apellido, $proyecto_nombre);
        
        if ($stmt->execute()) {
            echo "Asociación entre socio y proyecto eliminada con éxito.";
        } else {
            echo "Error al eliminar la asociación: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
