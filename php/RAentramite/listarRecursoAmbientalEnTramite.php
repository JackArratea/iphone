<?php
require_once '../conexionbd.php';

$sql = "SELECT * FROM RecursoAmbientalEnTramite";
$result = $conn->query($sql);

$recursos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recursos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($recursos);

$conn->close();
?>

