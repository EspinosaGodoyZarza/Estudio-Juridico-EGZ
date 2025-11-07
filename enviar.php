<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validar que los campos no estén vacíos
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirigir con error si hay campos vacíos o el email no es válido
        header("Location: index.html?status=error#contacto");
        exit;
    }

    // Dirección de correo a la que se enviará el mensaje
    $recipient = "estudiointegralzarza@gmail.com";

    // Asunto del correo
    $email_subject = "Nuevo mensaje de contacto: $subject";

    // Contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Encabezados del correo
    $email_headers = "From: $name <$email>";

    // Enviar el correo
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Redirigir con éxito si el correo se envió
        header("Location: index.html?status=success#contacto");
    } else {
        // Redirigir con error si falló el envío
        header("Location: index.html?status=error#contacto");
    }
} else {
    // No es una solicitud POST, redirigir a la página de inicio
    header("Location: index.html");
}
?>
