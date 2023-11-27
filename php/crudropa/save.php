<?php 
include("../conexion.php");

if (isset($_POST['save'])){
    $titulo = $_POST['titulo4'];
    $descripcion = $_POST['descripcion4'];
    $imagen='';
    $precio = $_POST['precio4'];

    if(isset($_FILES['images4'])){
        $file = $_FILES['images4'];
        $nombre = $file['name'];
        $tipo = $file["type"];
        $size = $file["size"];
        $ruta_provisional = $file["tmp_name"];

        // Verificar si se ha subido un archivo
        if (!empty($ruta_provisional)) {
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height =$dimensiones[1];
            $carpeta = "../../todo/images4/";

            if($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                echo "Error, el archivo no es una imagen";
            } else if ($size > 3*1024*1024) {
                echo "Error, el tamaño máximo permitido es de 3MB";
            } else {
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "../../todo/images4/" . $nombre;
            }
        }
    }

    $query = "INSERT INTO Tarea4(titulo4, descripcion4, images4, precio4) VALUES ('$titulo', '$descripcion', '$imagen', '$precio')";
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
