<?php
header('Content-Type: application/json');
require_once '../conexionbd.php'; // Asegúrate de que la ruta al archivo de conexión es correcta.

$sql = "SELECT * FROM centralelectrica"; // Cambia esto por tu consulta real.
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // Devolver un arreglo vacío si no hay resultados.
    $data = array();
}

echo json_encode($data);
$conn->close();
?>

