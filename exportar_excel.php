<?php
header("Content-Type: application/xls");        //Establece el tipo de contenido que se genera .xls
header("Content-Disposition: attachment; filename = excel.xls");    //Configura la disposición como una descarga y establece el nombre del archivo.

include("conexion.php");        //Incluimos la conexión a la base de datos
$sql = "SELECT * FROM usuarios ORDER BY id";
$resultado = $conexion->query($sql);

//Al igual que en index atrapamos los resultados de la consulta y si la condición se cumple esta se imprimira en las celdas del excel
if ($resultado->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
                <th>Edad</th>
            </tr>";
    
    while ($row = $resultado->fetch_assoc()) {

        // Calculamos la edad a partir de la variable fecha de nacimiento con el metodo "diff"
        $fechaNacimiento = new DateTime($row["nacimiento"]);
        $hoy = new DateTime();
        $edad = $fechaNacimiento->diff($hoy)->y;

        echo "<tr>
            <td>" . $row["nombre"] . "</td>
            <td>" . $row["sexo"] . "</td>
            <td>" . $row["nacimiento"] . "</td>
            <td>" . $edad . "</td>
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