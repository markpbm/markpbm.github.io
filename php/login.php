<?php

    session_start();

    include 'conexion.php';

    $correo = $_POST['correo2'];
    $contrasena = $_POST['contrasena2'];
    $contrasena = sha1($contrasena);

    $validar_login = mysqli_query($conn, "SELECT * FROM Administrador WHERE correo2='$correo' and contrasena2='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("location: ../reporte/reporte.php"); //Cambiar la localizacion
        exit;
    }else{
        echo '
            <script>
                alert("Usuario o contraseña incorrecta");
                window.location = "index2.php";
            </script>
        ';
        exit;
    }

?>