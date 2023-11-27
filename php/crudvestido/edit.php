<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Tarea5 WHERE idTarea5 = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $titulo = $row['titulo5'];
        $descripcion = $row['descripcion5'];
        $imagen = $row['images5'];
        $creacion = $row['fecha_registro5'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $titulo = $_POST['titulo5'];
    $descripcion = $_POST['descripcion5'];
    $precio = $_POST['precio5'];

    // Manejo de la carga de la nueva imagen
    if (isset($_FILES['images5']) && $_FILES['images5']['error'] == UPLOAD_ERR_OK) {
        // Procesar y mover la nueva imagen
        $target_dir = "../../todo/images5/";  // Directorio donde guardar las imágenes
        $target_file = $target_dir . basename($_FILES["images5"]["name"]);
        move_uploaded_file($_FILES["images5"]["tmp_name"], $target_file);

        // Actualizar la variable $imagen con la nueva ruta de la imagen
        $imagen = $target_file;
    }

    // Actualizar la base de datos
    // Después de actualizar la base de datos
    $query = "UPDATE Tarea5 SET titulo5 = '$titulo', descripcion5 = '$descripcion', images5 = '$imagen', precio5 = $precio WHERE idTarea5 = $id";
    mysqli_query($conn, $query);

    // Asignar mensaje y redirigir
    $_SESSION['mensaje'] = 'Tarea Actualizada Satisfactoriamente';
    $_SESSION['mensaje_type'] = 'success';
    header("Location: index.php");
    exit();

}
?>

<?php include("includes/header.php") ?>

<div class="container">
    <div class="fila">
        <div class="columna-4">
            <div class="card">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="titulo5" value="<?php echo $titulo; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion5" rows="2" class="form-control" placeholder="Actualiza descripción"><?php echo $descripcion; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="images5" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="number" name="precio5" value="<?php echo $precio; ?>" class="form-control" step="0.01">
                    </div>
                    <button class="btn-satisfactorio" name="update">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
