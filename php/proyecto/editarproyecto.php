<?php
require_once '../conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger el ID del proyecto y los nuevos valores del formulario
    $id = $_POST['id']; // Asegúrate de que este campo esté presente en tu formulario como un input oculto o como parte de la solicitud
    $nombre_nuevo = $_POST['nombre_nuevo'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $fecha_apertura = $_POST['fecha_apertura'];
    $operativa = $_POST['operativa'];

    // Preparar la consulta SQL utilizando el ID para identificar el proyecto
    $sql = "UPDATE Proyecto SET nombre = ?, latitud = ?, longitud = ?, region = ?, comuna = ?, fecha_apertura = ?, operativa = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Vincular las variables a los parámetros de la consulta
        $stmt->bind_param("sddssssi", $nombre_nuevo, $latitud, $longitud, $region, $comuna, $fecha_apertura, $operativa, $id);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Proyecto actualizado con éxito.";
        } else {
            echo "Error al actualizar el proyecto: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
