<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST["telefono"]);
    $asunto = trim($_POST["asunto"]);
    $mensaje = trim($_POST["mensaje"]);

    if (empty($nombre) || empty($asunto) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, completa el formulario correctamente.";
        exit;
    }

    $recipient = "ord.gorka@gmail.com";
    $subject = "Nuevo mensaje de $nombre: $asunto";
    $email_content = "Nombre: $nombre\n";
    $email_content .= "Correo Electrónico: $email\n";
    $email_content .= "Teléfono: $telefono\n\n";
    $email_content .= "Mensaje:\n$mensaje\n";

    $email_headers = "From: $nombre <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Gracias! Tu mensaje ha sido enviado.";
    } else {
        http_response_code(500);
        echo "Lo sentimos, algo salió mal.";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema con tu envío. Por favor intenta nuevamente.";
}
?>
