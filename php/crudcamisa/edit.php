<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Tarea3 WHERE idTarea3 = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $titulo = $row['titulo3'];
        $descripcion = $row['descripcion3'];
        $imagen = $row['images3'];
        $creacion = $row['fecha_registro3'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $titulo = $_POST['titulo3'];
    $descripcion = $_POST['descripcion3'];
    $precio = $_POST['precio3'];

    // Manejo de la carga de la nueva imagen
    if (isset($_FILES['images3']) && $_FILES['images3']['error'] == UPLOAD_ERR_OK) {
        // Procesar y mover la nueva imagen
        $target_dir = "../../todo/images3/";  // Directorio donde guardar las imágenes
        $target_file = $target_dir . basename($_FILES["images3"]["name"]);
        move_uploaded_file($_FILES["images3"]["tmp_name"], $target_file);

        // Actualizar la variable $imagen con la nueva ruta de la imagen
        $imagen = $target_file;
    }

    // Actualizar la base de datos
    // Después de actualizar la base de datos
    $query = "UPDATE Tarea3 SET titulo3 = '$titulo', descripcion3 = '$descripcion', images3 = '$imagen', precio3 = $precio WHERE idTarea3 = $id";
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
                        <input type="text" name="titulo3" value="<?php echo $titulo; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion3" rows="2" class="form-control" placeholder="Actualiza descripción"><?php echo $descripcion; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="images3" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="number" name="precio3" value="<?php echo $precio; ?>" class="form-control" step="0.01">
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
