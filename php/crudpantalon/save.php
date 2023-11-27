<?php
include("../conexion.php");

if (isset($_POST['save'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = '';
    $precio = $_POST['precio'];

    if (isset($_FILES['images'])) {
        $file = $_FILES['images'];
        $nombre = $file['name'];
        $tipo = $file["type"];
        $size = $file["size"];
        $ruta_provisional = $file["tmp_name"];

        // Verificar si se ha subido un archivo
        if (!empty($ruta_provisional)) {
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "../../todo/images/";

            // Validar tipo y tamaño del archivo
            $tipos_permitidos = ['image/jpg', 'image/JPG', 'image/jpeg', 'image/png', 'image/gif'];
            $tamano_maximo = 3 * 1024 * 1024; // 3MB

            if (!in_array($tipo, $tipos_permitidos)) {
                echo "Error, el archivo no es una imagen";
            } elseif ($size > $tamano_maximo) {
                echo "Error, el tamaño máximo permitido es de 3MB";
            } else {
                $src = $carpeta . $nombre;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "../../todo/images/" . $nombre;
            }
        }
    }

    $query = "INSERT INTO Tarea(titulo, descripcion, images, precio) VALUES ('$titulo', '$descripcion', '$imagen', '$precio')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    session_start();

    $_SESSION['mensaje'] = 'Tarea guardada exitosamente';
    $_SESSION['mensaje_type'] = 'success';

    header("Location: index.php"); // Redirige después de crear la tarea.
}
?>
