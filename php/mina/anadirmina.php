<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $mineral = trim($_POST['mineral']);

    $sql = "INSERT INTO Mina (nombre, mineral) VALUES (?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $nombre, $mineral);
        
        if ($stmt->execute()) {
            echo "Nueva mina añadida con éxito.";
        } else {
            echo "Error al añadir la mina: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
