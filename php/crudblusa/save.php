<?php 
include("../conexion.php");

if (isset($_POST['save'])){
    $titulo = $_POST['titulo2'];
    $descripcion = $_POST['descripcion2'];
    $imagen='';
    $precio = $_POST['precio2'];

    if(isset($_FILES['images2'])){
        $file = $_FILES['images2'];
        $nombre = $file['name'];
        $tipo = $file["type"];
        $size = $file["size"];
        $ruta_provisional = $file["tmp_name"];

        // Verificar si se ha subido un archivo
        if (!empty($ruta_provisional)) {
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height =$dimensiones[1];
            $carpeta = "../../todo/images2/";

            if($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                echo "Error, el archivo no es una imagen";
            } else if ($size > 3*1024*1024) {
                echo "Error, el tamaño máximo permitido es de 3MB";
            } else {
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "../../todo/images2/" . $nombre;
            }
        }
    }

    $query = "INSERT INTO Tarea2(titulo2, descripcion2, images2, precio2) VALUES ('$titulo', '$descripcion', '$imagen', '$precio')";
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
