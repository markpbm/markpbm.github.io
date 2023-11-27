<?php
include("conexion.php"); // Incluye el archivo de conexión

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario de contacto
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasena = md5($_POST["contrasena"]);

    
    // Verifica si el correo ya está registrado en la base de datos
    $correo_existente = false;
    $sql_verificar_correo = "SELECT correo FROM Usuario WHERE correo = ?";
    $stmt_verificar_correo = $conn->prepare($sql_verificar_correo);
    $stmt_verificar_correo->bind_param("s", $correo);
    $stmt_verificar_correo->execute();
    $stmt_verificar_correo->store_result();
    if ($stmt_verificar_correo->num_rows > 0) {
        $correo_existente = true;
    }
    $stmt_verificar_correo->close();

    if ($correo_existente) {
        echo "El correo electrónico ya está registrado.";
    } else {

        // Prepara la sentencia SQL para insertar los datos en la tabla
        $sql = "INSERT INTO Usuario (nombre, apellido, correo, contrasena)
                VALUES (?, ?, ?, ?)";

        // Preparar la sentencia SQL
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error al preparar la sentencia SQL: " . $conexion->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("ssss", $nombre, $apellido, $correo, $contrasena);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Envía el correo de confirmación
            enviarCorreoConfirmacion($nombre, $apellido, $correo, $contrasena);

            echo "¡Registro exitoso! Se ha enviado un correo de confirmación.";
        } else {
            echo "Error al registrar los datos: " . $stmt->error;
        }

        // Cierra la sentencia
        $stmt->close();
    }
} else {
    echo "El formulario no se ha enviado.";
}

// Función para enviar el correo de confirmación
function enviarCorreoConfirmacion($nombre, $apellido, $correo, $contrasena) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'marklucianopandurobartra@gmail.com';
    $mail->Password = 'cskd ihca huqn zmgf';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('marklucianopandurobartra@gmail.com', 'Mark');
    $mail->addAddress($correo);
    
    // Configuración de codificación de caracteres
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->isHTML(true);
    $mail->Subject = "Confirmación de registro";
    $mensaje = "";

    $mail->Body = "Estimado $nombre $apellido,<br><br>Gracias por registrarte a TODO A TU ALCANCE. Tus datos de registro son los siguientes:<br><br>
    Nombre: $nombre<br>Apellido: $apellido<br>Correo: $correo<br>Contraseña: $contrasena";
    // Envía el correo
    if ($mail->send()) {
        echo "Correo de confirmación enviado correctamente.";
    } else {
        echo "Error al enviar el correo de confirmación: " . $mail->ErrorInfo;
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>