<?php

    require("conexionpdf.php");
    $sql = "SELECT * FROM usuarios";
    $stmt = $conexion->prepare($sql);
    $result = $stmt->execute();
    $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach($rows as $row){
        print $row["id"].";".$row["nombre"].";".$row["sexo"].";".$row["nacimiento"]."\n";
    }

    

    
?>