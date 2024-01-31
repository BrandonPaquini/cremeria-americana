<?php
// Conexion a la base de datos
$servername = "65.99.248.161";
$username = "amigoeq1_cremeria_user";
$password = "cremeria_pass";
$dbname = "amigoeq1_cremeria_test";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
else{
    //echo "Conexión exitosa";
}
?>
