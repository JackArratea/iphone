<?php
require_once '../conexionbd.php'; // Incluir el archivo de configuración para la conexión a la base de datos.

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nacionalidad = trim($_POST['nacionalidad']);

    // Preparar la consulta SQL
    $sql = "INSERT INTO Socio (nombre, apellido, nacionalidad) VALUES (?, ?, ?)";
    
    // Asegurarse de que la conexión a la base de datos está abierta
    if ($conn && !$conn->connect_error) {
        // Preparar la sentencia
        if ($stmt = $conn->prepare($sql)) {
            // Vincular los parámetros a la sentencia
            $stmt->bind_param("sss", $nombre, $apellido, $nacionalidad);
            
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                echo "Nuevo socio creado con éxito.";
            } else {
                echo "Error al crear socio: " . $stmt->error;
            }
            
            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Error de conexión: " . $conn->connect_error;
    }
}
$conn->close();
?>


