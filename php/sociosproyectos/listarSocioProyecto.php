<?php
require_once '../conexionbd.php';

$sql = "SELECT socio_nombre, socio_apellidos, proyecto_nombre FROM Socios_Proyectos";
$resultado = $conn->query($sql);

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['socio_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['socio_apellidos']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['proyecto_nombre']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No se encontraron datos</td></tr>";
}
$conn->close();
?>


