<!-- Documento Index-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Cremeria Americana</title>


  <!--Funcion JS para desaparecer el texto-->
  <script>
    function mostrarMensaje(mensaje) {
      // Muestra el mensaje
      document.getElementById('mensaje').innerHTML = mensaje;
      document.getElementById('mensaje').style.display = 'block';

      // Oculta el mensaje después de 3 segundos (3000 milisegundos)
      setTimeout(function() {
        document.getElementById('mensaje').style.display = 'none';
      }, 3000);
    }
  </script>
  

</head>
<body>
    <div id="mensaje" style="display: none; color: green;"></div>
    <h2>Ingrese sus Datos Personales</h2>


    <!--Formulario para obtener los datos de registro a la Base de Datos-->
    <form action="enviodedatos.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

    
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>

    
        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required>

    
        <button type="submit">Enviar</button>
    </form>

    <!--Botón para exportar el Excel-->
    <div>
        <a href="exportar_excel.php" target="_blank">
            <button>Exportar a Excel</button>
        </a>
    </div>
</body>
</html>

<?php

include("conexion.php");

// Logica para eliminar usuarios
if(isset($_POST['eliminar'])) {
    // Obtener el ID del usuario a eliminar
    $idEliminar = $_POST['idEliminar'];
    $sqlEliminar = "DELETE FROM usuarios WHERE id = '$idEliminar'";

    // Ejecutar la consulta de Eliminación
    if ($conexion->query($sqlEliminar) === TRUE) {
        echo "<script>mostrarMensaje('Registro eliminado correctamente.');</script>";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

// Logica para modificar usuarios
if(isset($_POST['modificar'])) {
    $idModificar = $_POST['idModificar'];
    $nombreModificar = $_POST['nombreModificar'];
    $sexoModificar = $_POST['sexoModificar'];
    $fechaNacimientoModificar = $_POST['fechaNacimientoModificar'];

    // Consulta SQL para actualizar el registro
    $sqlModificar = "UPDATE usuarios SET nombre='$nombreModificar', sexo='$sexoModificar', nacimiento='$fechaNacimientoModificar' WHERE id='$idModificar'";

    // Ejecutar la consulta de modificación
    if ($conexion->query($sqlModificar) === TRUE) {
        echo "<script>mostrarMensaje('Registro modificado correctamente.');</script>";
    } else {
        echo "Error al modificar el registro: " . $conexion->error;
    }
}

// Logica para mostrar la tabala con los registros todo el tiempo
$sql = "SELECT * FROM usuarios ORDER BY id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>";
    
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["nombre"] . "</td>
            <td>" . $row["sexo"] . "</td>
            <td>" . $row["nacimiento"] . "</td>
            
                    <td>

                    <!--Formulario donde se modifican los registros-->
                    <form method='post' action=''>
                        <input type='hidden' name='idModificar' value='" . $row["id"] . "'>
                        <label for='nombreModificar'>Nuevo Nombre:</label>
                        <input type='text' name='nombreModificar'>
                        <label for='sexoModificar'>Nuevo Sexo:</label>
                        <select name='sexoModificar'>
                            <option value='masculino'>Masculino</option>
                            <option value='femenino'>Femenino</option>
                            <option value='otro'>Otro</option>
                        </select>
                        <label for='fechaNacimientoModificar'>Nueva Fecha de Nacimiento:</label>
                        <input type='date' name='fechaNacimientoModificar'>
                        <button type='submit' name='modificar'>Modificar</button>
                    </td>
                    <td>
                    
                    <!--Formulario de donde se toma el Id para eliminar el registro-->
                    <form method='post' action=''>
                        <input type='hidden' name='idEliminar' value='" . $row["id"] . "'>
                        <button type='submit' name='eliminar'>Eliminar</button>            
                    </form>
                    </td>    
            </tr>";
            }
        
    echo "</table>";
    } 
    else {
            echo "No hay datos en la tabla.";
    }
        
        // Cerrar la conexión a la base de datos al finalizar
    $conexion->close()

?>