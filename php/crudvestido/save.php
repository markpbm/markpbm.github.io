<?php 
include("../conexion.php");

if (isset($_POST['save'])){
    $titulo = $_POST['titulo5'];
    $descripcion = $_POST['descripcion5'];
    $imagen='';
    $precio = $_POST['precio5'];

    if(isset($_FILES['images5'])){
        $file = $_FILES['images5'];
        $nombre = $file['name'];
        $tipo = $file["type"];
        $size = $file["size"];
        $ruta_provisional = $file["tmp_name"];

        // Verificar si se ha subido un archivo
        if (!empty($ruta_provisional)) {
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height =$dimensiones[1];
            $carpeta = "../../todo/images5/";

            if($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                echo "Error, el archivo no es una imagen";
            } else if ($size > 3*1024*1024) {
                echo "Error, el tamaño máximo permitido es de 3MB";
            } else {
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, $src);
                $imagen = "../../todo/images5/" . $nombre;
            }
        }
    }

    $query = "INSERT INTO Tarea5(titulo5, descripcion5, images5, precio5) VALUES ('$titulo', '$descripcion', '$imagen', '$precio')";
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
