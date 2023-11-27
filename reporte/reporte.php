<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor iniciar sesion");
                window.location = "../php/index2.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario y Tabla de Datos</title>
    <link rel="stylesheet" href="reporte.css">
</head>
<body>
    <a class="Boton" href="../php/cerrar_sesion.php">Cerrar sesion</a>
    <h1>Buscar en la Tabla de Datos</h1>

    <!-- Formulario de búsqueda -->
    <form method="POST" action="">
        <label for="busquedaNombre">Buscar Nombre:</label>
        <input type="text" id="busquedaNombre" name="busquedaNombre" placeholder="Ingresa un nombre">
        <label for="busquedaApellido">Buscar Apellido:</label>
        <input type="text" id="busquedaApellido" name="busquedaApellido" placeholder="Ingresa un apellido">
        <button type="submit">Buscar</button>
    </form>
    <a href="../php/crudpantalon/index.php">CRUDPANTALON</a>
    <a href="../php/crudblusa/index.php">CRUDBLUSA</a>
    <a href="../php/crudcamisa/index.php">CRUDCAMISA</a>
    <a href="../php/crudropa/index.php">CRUDROPA</a>
    <a href="../php/crudvestido/index.php">CRUDVESTIDO</a>
    <a href="../php/crudzapatilla/index.php">CRUDZAPATILLA</a>

    <?php
    include("../php/conexion.php");

    // Verifica si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesa el formulario de búsqueda
        $nombreBuscado = $_POST['busquedaNombre'];
        $apellidoBuscado = $_POST['busquedaApellido'];

        $sql = "SELECT * FROM Usuario WHERE 1";

        if (!empty($nombreBuscado)) {
            $sql .= " AND nombre LIKE '%$nombreBuscado%'";
        }

        if (!empty($apellidoBuscado)) {
            $sql .= " AND apellido LIKE '%$apellidoBuscado%'";
        }

        $result = $conn->query($sql);

        if (!$result) {
            die("Error en la consulta: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            echo "<h2>Resultados de la Búsqueda:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["idUsuario"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["apellido"] . "</td>
                        <td>" . $row["correo"] . "</td>
                        <td>" . $row["contrasena"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados para los criterios de búsqueda.</p>";
        }
    } else {
        // Si no se envió el formulario, muestra todos los usuarios
        $sql = "SELECT * FROM Usuario";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Todos los Usuarios:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Contraseña</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["idUsuario"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["apellido"] . "</td>
                        <td>" . $row["correo"] . "</td>
                        <td>" . $row["contrasena"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
    }

    $conn->close();
    ?>
</body>
</html>
