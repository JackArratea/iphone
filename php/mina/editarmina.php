<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_original = trim($_POST['nombre_original']);
    $nombre = trim($_POST['nombre']);
    $mineral = trim($_POST['mineral']);

    $sql = "UPDATE Mina SET nombre = ?, mineral = ? WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $nombre, $mineral, $nombre_original);
        
        if ($stmt->execute()) {
            echo "Mina actualizada con éxito.";
        } else {
            echo "Error al actualizar la mina: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
