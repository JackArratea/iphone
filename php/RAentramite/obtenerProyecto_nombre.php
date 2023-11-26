<?php
require_once '../conexionbd.php';

$sql = "SELECT nombre, fecha_apertura FROM proyecto"; // Asegúrate de que los nombres de columna son correctos.
$result = $conn->query($sql);

// Ejemplo de cómo podría ser tu script PHP
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "nombre" => $row["nombre"],
        "fecha_apertura" => $row["fecha_apertura"]
    );
}
echo json_encode($data);

$conn->close();
?>

