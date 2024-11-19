<?php
$usuario = "root"; 
$contra = "Raistl1n"; 
$base = "mete0"; 
$servidor = "localhost";

// Recibir datos desde el POST
$temp = isset($_POST['temp']) ? floatval($_POST['temp']) : null;
$hum = isset($_POST['hum']) ? floatval($_POST['hum']) : null;
$pres = isset($_POST['pres']) ? floatval($_POST['pres']) : null;

// Validar que los datos no sean nulos
if ($temp === null || $hum === null || $pres=== null) {
    echo "Error: Datos incompletos.";
    exit;
}

// Crear conexión
$mysqli = new mysqli($servidor, $usuario, $contra, $base);

// Validar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$fecha = date('Y-m-d H:i:s'); // Formato estándar para fechas en MySQL

// Preparar consulta
$sql = $mysqli->prepare("INSERT INTO datos (fecha,temperatura, humedad,presion) VALUES (?,?,?,?)");
$sql->bind_param("sddd", $fecha,  $temp, $hum,$pres);

// Ejecutar consulta
if ($sql->execute()) {
    echo "Hecho!";
} else {
    echo "Error: " . $mysqli->error;
}

// Cerrar conexión
$sql->close();
$mysqli->close();
?>

