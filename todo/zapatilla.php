<?php
include("../php/conexion.php");


$query = "SELECT * FROM Tarea6";
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
                        <img src="images6/<?php echo $row['images6'] ?>" alt="Imagen de la tarea">
                    </figure>
                </div>
                <div class="contenido">
                    <h2><?php echo $row['titulo6'] ?></h2>
                    <p><?php echo $row['descripcion6'] ?></p>
                    <p>Precio: $<?php echo $row['precio6'] ?></p>
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
