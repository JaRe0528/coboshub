<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    
    // Generar un token de recuperación
    $token = bin2hex(random_bytes(50));
    
    // Guardar el token en la base de datos (esto es solo un ejemplo, debes usar una base de datos real)
    // $database->query("INSERT INTO password_resets (email, token) VALUES ('$correo', '$token')");
    
    // Configuración del correo
    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Reemplaza con tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Reemplaza con tu dirección de correo
        $mail->Password = 'your_password'; // Reemplaza con tu contraseña
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Destinatarios
        $mail->setFrom('no-reply@example.com', 'CobosHub');
        $mail->addAddress($correo);
        
        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = "Haz clic en el siguiente enlace para recuperar tu contraseña: <a href='https://example.com/reset_password.php?token=$token'>Recuperar Contraseña</a>";
        
        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
    }
} else {
    echo 'Método no permitido';
}
?>
