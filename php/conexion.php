<?php

$servername = "localhost"; // Cambia esto si tu base de datos no se encuentra en localhost
$username = "root";
$password = "base_de_datosmark21";
$database = "finalsemestre";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}
?>