<?php include("../conexion.php") ?>
<?php include("includes/header.php") ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "deleted") {
        $_SESSION['mensaje'] = "La tarea ha sido eliminada satisfactoriamente.";
        $_SESSION['mensaje_type'] = "success";
    } elseif ($status == "error") {
        $_SESSION['mensaje'] = "Ha ocurrido un error al intentar eliminar la tarea.";
        $_SESSION['mensaje_type'] = "error";
    }
}
?>

<div class="container">
    <div class="fila">
        <div class="columna-4">
            <?php if(isset($_SESSION['mensaje']) && isset($_SESSION['mensaje_type'])) { ?>
                <div class="mensaje <?= $_SESSION['mensaje_type'] ?>" id="mensaje-popup">
                    <?= $_SESSION['mensaje'] ?>
                    <span class="cerrar-mensaje" onclick="cerrarMensaje()">&times;</span>
                </div>
            <?php 
                unset($_SESSION['mensaje']);
                unset($_SESSION['mensaje_type']);
            } ?>

            <div class="card">
                <form action="save.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control" placeholder="Tarea" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea type="textarea" name="descripcion" class="form-control" placeholder="Descripcion de la Tarea"></textarea>
                    </div>
                    <div class="form-group">
                    <input type="file" name="images" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="number" name="precio" class="form-control" step="0.01" placeholder="Ingrese el precio" autofocus>
                    </div>
                    <input type="submit" class="btn" name="save" value="Guardar Tarea">
                </form>
            </div>
        </div>

        <div class="columna-8">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    $query = "SELECT * FROM Tarea";
                    $result_tareas = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_array($result_tareas)){ ?>
                        <tr>
                            <td><?php echo $row['titulo'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['images'] ?></td>
                            <td><?php echo $row['precio'] ?></td>
                            <td><?php echo $row['fecha_registro'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['idTarea']?>" class="btn1">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $row['idTarea']?>&status=deleted" class="btn2">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
