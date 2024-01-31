<?php
$servername = "65.99.248.161";
$username = "amigoeq1_cremeria_user";
$password = "cremeria_pass";
$dbname = "amigoeq1_cremeria_test";

try{
    $conexion = new PDO('mysql:host='.$servername. ';dbname=' .$dbname,$username,$password);
    
}catch(PDOException $e){
    echo "Error de conexión";
    exit;
}

return $conexion;

?>