<?php
include("../php/conexion.php");


$query = "SELECT * FROM Tarea4";
$result_tareas = mysqli_query($conn, $query);

if (!$result_tareas) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include("includes/header.php"); ?>

<div class="contenedor-cartra">
    <div class="contenedor">
        <?php  
        while($row = mysqli_fetch_array($result_tareas)){ ?>
            <div class="carta">
                <div class="imagen">
                    <figure>
                        <img src="images4/<?php echo $row['images4'] ?>" alt="Imagen de la tarea">
                    </figure>
                </div>
                <div class="contenido">
                    <h2><?php echo $row['titulo4'] ?></h2>
                    <p><?php echo $row['descripcion4'] ?></p>
                    <p>Precio: $<?php echo $row['precio4'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
// Cierra la conexión después de usarla
mysqli_close($conn);
?>

<!-- Agrega aquí tu código HTML adicional si lo necesitas -->

<?php include("includes/footer.php"); ?>
