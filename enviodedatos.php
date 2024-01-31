<!--Envio de datos a partir de HTML y enviados por PHP

<?php
//Incluimos la conexión a la base de datos
include("conexion.php");

// Procesamos los datos obtenidos en el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $sexo = $_POST["sexo"];
    $fechaNacimiento = $_POST["fechaNacimiento"];


    // Consulta de inserción de datos la tabla
    $sql = "INSERT INTO usuarios (nombre, sexo, nacimiento) VALUES ('$nombre', '$sexo', '$fechaNacimiento')";

    if ($conexion->query($sql) === TRUE) {
        
        echo "Registro insertado correctamente";
        header("Location: /cremeria/index.php"); //Redirigimos al archivo de inicio una vez hecha la inserción
        exit(); // Asegura que el script se detenga después de enviar la ubicación de redirección

    } else {
        echo "Error al insertar el registro: " . $conexion->error;
    }
}

// Cerrar la conexión a la base de datos al finalizar
$conexion->close();
?>
