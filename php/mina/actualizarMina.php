<?php
require_once '../conexionbd.php';

// Comprueba si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los valores enviados desde el formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $mineral = $_POST['mineral'];
    // Añade aquí más campos si es necesario

    // Prepara la consulta SQL para actualizar los datos
    $sql = "UPDATE Mina SET nombre = ?, mineral = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincula los parámetros a la sentencia preparada
    $stmt->bind_param("ssi", $nombre, $mineral, $id);

    // Ejecuta la sentencia
    if ($stmt->execute()) {
        echo "Mina actualizada con éxito.";
    } else {
        echo "Error al actualizar la mina: " . $stmt->error;
    }

    // Cierra la sentencia y la conexión
    $stmt->close();
    $conn->close();
}
?>
