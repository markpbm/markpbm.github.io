<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Tarea4 WHERE idTarea4 = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $titulo = $row['titulo4'];
        $descripcion = $row['descripcion4'];
        $imagen = $row['images4'];
        $creacion = $row['fecha_registro4'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $titulo = $_POST['titulo4'];
    $descripcion = $_POST['descripcion4'];
    $precio = $_POST['precio4'];

    // Manejo de la carga de la nueva imagen
    if (isset($_FILES['images4']) && $_FILES['images4']['error'] == UPLOAD_ERR_OK) {
        // Procesar y mover la nueva imagen
        $target_dir = "../../todo/images4/";  // Directorio donde guardar las imágenes
        $target_file = $target_dir . basename($_FILES["images4"]["name"]);
        move_uploaded_file($_FILES["images4"]["tmp_name"], $target_file);

        // Actualizar la variable $imagen con la nueva ruta de la imagen
        $imagen = $target_file;
    }

    // Actualizar la base de datos
    // Después de actualizar la base de datos
    $query = "UPDATE Tarea4 SET titulo4 = '$titulo', descripcion4 = '$descripcion', images4 = '$imagen', precio4 = $precio WHERE idTarea4 = $id";
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
                        <input type="text" name="titulo4" value="<?php echo $titulo; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion4" rows="2" class="form-control" placeholder="Actualiza descripción"><?php echo $descripcion; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="images4" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="number" name="precio4" value="<?php echo $precio; ?>" class="form-control" step="0.01">
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
