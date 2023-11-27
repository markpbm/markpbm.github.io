<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php"); // Incluye el archivo de conexión
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario de contacto
    $nombre = $_POST["nombre_contacto"];
    $apellido = $_POST["apellido_contacto"];
    $correo = $_POST["correo_contacto"];
    $numero = $_POST["numero"];
    $comentario = $_POST["comentario"];

    // Prepara la sentencia SQL para insertar los datos en la tabla
    $sql = "INSERT INTO Contacto (nombre_contacto, apellido_contacto, correo_contacto, numero, comentario)
            VALUES (?, ?, ?, ?, ?)";

    // Preparar la sentencia SQL
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la sentencia SQL: " . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("sssss", $nombre, $apellido, $correo, $numero, $comentario);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Envía una notificación a tu correo
        enviarNotificacion($nombre, $apellido, $correo, $numero, $comentario);
    
        echo "<script>alert('El mensaje se ha enviado.'); window.location.href='.././index.html';</script>";
    } else {
        echo "<script>alert('Hubo un error al enviar el mensaje: " . $stmt->error . "');</script>";
    }
    
    // Cierra la sentencia
    $stmt->close();
} else {
    echo "<script>alert('El comentario no se ha enviado.'); window.location.href='.././index.html';</script>";
}

// Función para enviar una notificación a tu correo utilizando PHPMailer
function enviarNotificacion($nombre, $apellido, $correo, $numero, $comentario) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marklucianopandurobartra@gmail.com';
        $mail->Password = 'cskd ihca huqn zmgf';
        $mail->SMTPSecure = 'tls'; // Cambiado a tls
        $mail->Port = 587; // Cambiado el puerto a 587

        $mail->setFrom('marklucianopandurobartra@gmail.com', 'Notificaciones');
        $mail->addAddress('marklucianopandurobartra@gmail.com'); // Reemplaza con tu dirección de correo

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto";

        $mail->Body = "Se ha recibido un nuevo mensaje de contacto:<br><br>
                   Nombre: $nombre<br>
                   Apellido: $apellido<br>
                   Correo: $correo<br>
                   Número: $numero<br>
                   Comentario: $comentario";

        $mail->SMTPDebug = 0; // Cambiado a 0 para desactivar la depuración

        $mail->send();
        $mail->smtpClose(); // Cierra el objeto de PHPMailer
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar la notificación: " . $e->getMessage() . "');</script>";
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
