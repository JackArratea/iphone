<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']); // Asumimos que se pasa un 'id' único para identificar al socio.

    $sql = "DELETE FROM Socio WHERE id = ?"; // Asegúrate de tener un campo 'id' o utiliza el nombre y apellido como claves.
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo "Socio eliminado con éxito.";
        } else {
            echo "Error al eliminar socio: " . $stmt->error;
        }
        $stmt->close();
    }
    
    $conn->close();
}
?>
