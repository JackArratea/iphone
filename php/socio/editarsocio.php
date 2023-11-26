<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nacionalidad = trim($_POST['nacionalidad']);
    $id = trim($_POST['id']); // Asumimos que se pasa un 'id' único para identificar al socio.

    $sql = "UPDATE Socio SET nombre = ?, apellido = ?, nacionalidad = ? WHERE id = ?"; // Asegúrate de tener un campo 'id' o utiliza el nombre y apellido como claves.
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $nombre, $apellido, $nacionalidad, $id);
        
        if ($stmt->execute()) {
            echo "Socio actualizado con éxito.";
        } else {
            echo "Error al actualizar socio: " . $stmt->error;
        }
        $stmt->close();
    }
    
    $conn->close();
}
?>
