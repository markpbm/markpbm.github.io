<?php
include("../conexion.php");

// Verificar si se proporciona un ID y si está configurado el estado
if (isset($_GET['id']) && isset($_GET['status'])) {
    $idTarea = $_GET['id'];

    // Obtener el nombre de la imagen asociada a la tarea
    $query = "SELECT images6 FROM Tarea6 WHERE idTarea6 = $idTarea";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $nombreImagen = $row['images6'];

        // Eliminar la imagen del sistema de archivos
        unlink('../../todo/images/' . $nombreImagen);

        // Realizar la operación de eliminación
        $query = "DELETE FROM Tarea6 WHERE idTarea6 = $idTarea";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redireccionar a index.php con mensaje de éxito
            header("Location: index.php?status=deleted");
            exit();
        } else {
            // Redireccionar a index.php con mensaje de error
            header("Location: index.php?status=error");
            exit();
        }
    } else {
        // Tarea no encontrada, redireccionar a index.php con mensaje de error
        header("Location: index.php?status=error");
        exit();
    }
} else {
    // Redireccionar a index.php si no se proporciona un ID
    header("Location: index.php");
    exit();
}
?>
