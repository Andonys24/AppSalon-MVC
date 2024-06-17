<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {

        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '9513fdc5f5135d';
        $mail->Password = '8a2bb879758caa';
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirmar tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<head>';
        $contenido .= '<style>';
        $contenido .= 'body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }';
        $contenido .= '.container { width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }';
        $contenido .= '.header { text-align: center; }';
        $contenido .= '.button { display: inline-block; padding: 10px 20px; margin-top: 20px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px; }';
        $contenido .= '.footer { margin-top: 20px; font-size: 0.9em; color: #555; }';
        $contenido .= '</style>';
        $contenido .= '</head>';
        $contenido .= '<body>';
        $contenido .= '<div class="container">';
        $contenido .= '<div class="header">';
        $contenido .= '<h1>Bienvenido a App Salón</h1>';
        $contenido .= '</div>';
        $contenido .= "<p>Hola <strong>" . htmlspecialchars($this->nombre, ENT_QUOTES, 'UTF-8') . "</strong>,</p>";
        $contenido .= "<p>Has creado tu cuenta en App Salón. Solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p><a href='http://localhost:3000/confirmar-cuenta?token=" . urlencode($this->token) . "' class='button'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar este mensaje. Nadie más podrá confirmar tu cuenta sin tu autorización.</p>";
        $contenido .= '<div class="footer">';
        $contenido .= '<p>Gracias,</p>';
        $contenido .= '<p>El equipo de App Salón</p>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '9513fdc5f5135d';
        $mail->Password = '8a2bb879758caa';
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Restablecer tu Password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<head>';
        $contenido .= '<style>';
        $contenido .= 'body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f8f8f8; padding: 20px; }';
        $contenido .= '.container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 10px; }';
        $contenido .= '.header { text-align: center; margin-bottom: 20px; }';
        $contenido .= '.header h1 { margin: 0; color: #007bff; }';
        $contenido .= '.content { text-align: left; }';
        $contenido .= '.button { display: inline-block; padding: 10px 20px; margin-top: 20px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px; }';
        $contenido .= '.footer { margin-top: 20px; font-size: 0.9em; color: #555; text-align: center; }';
        $contenido .= '</style>';
        $contenido .= '</head>';
        $contenido .= '<body>';
        $contenido .= '<div class="container">';
        $contenido .= '<div class="header">';
        $contenido .= '<h1>App Salón</h1>';
        $contenido .= '</div>';
        $contenido .= '<div class="content">';
        $contenido .= "<p>Hola <strong>" . htmlspecialchars($this->nombre, ENT_QUOTES, 'UTF-8') . "</strong>,</p>";
        $contenido .= "<p>Has solicitado restablecer tu contraseña. Para proceder, por favor, sigue el siguiente enlace:</p>";
        $contenido .= "<p><a href='http://localhost:3000/recuperar?token=" . urlencode($this->token) . "' class='button'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si tú no solicitaste este cambio, por favor, ignora este mensaje.</p>";
        $contenido .= '</div>';
        $contenido .= '<div class="footer">';
        $contenido .= '<p>Gracias,</p>';
        $contenido .= '<p>El equipo de App Salón</p>';
        $contenido .= '</div>';
        $contenido .= '</div>';
        $contenido .= '</body>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}
