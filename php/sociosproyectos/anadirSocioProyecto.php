<?php
require_once '../conexionbd.php';

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Recibe los datos del formulario
$nombreProyecto = $_POST['nombreProyecto'];
$socioId = $_POST['socioId'];

// Consulta para obtener el nombre y apellido del socio
$sqlSocio = "SELECT nombre, apellido FROM socio WHERE id = ?";
$stmtSocio = $conn->prepare($sqlSocio);
$stmtSocio->bind_param("s", $socioId);
$stmtSocio->execute();
$resultSocio = $stmtSocio->get_result();

$response = array();

if ($resultSocio->num_rows > 0) {
    $rowSocio = $resultSocio->fetch_assoc();
    $nombreSocio = $rowSocio['nombre'];
    $apellidoSocio = $rowSocio['apellido'];

 


    $sql = "INSERT INTO socios_proyectos (socio_nombre, socio_apellidos, proyecto_nombre) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombreSocio, $apellidoSocio, $nombreProyecto);


    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Proyecto y socio agregados con éxito.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error al agregar el proyecto y socio: " . $stmt->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = "No se encontró al socio con el ID proporcionado.";
}

$stmtSocio->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>

