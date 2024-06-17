<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login');
    }
    public static function logout(Router $router)
    {
        echo 'Desde Logout';
    }
    public static function olvide(Router $router)
    {
        $router->render('auth/olvide-password', []);
    }
    public static function recuperar(Router $router)
    {
        echo 'Desde recuperar';
    }
    public static function crear(Router $router)
    {
        $usuario = new Usuario($_POST);

        // Alertas vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar(($_POST));
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que alertas este vacio
            if (empty($alertas)) {
                // Verificar si el usuario ya esta registrado
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // No esta Registrado
                    // Hashear el password
                    $usuario->hashPassword();
                    // Generar Token unico
                    $usuario->crearToken();

                    // Enviar Email con Token
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    // Enviar Confirmacion
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            "usuario" => $usuario,
            "alertas" => $alertas,
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No valido');
        } else {
            // Modificara usuario a confirmado
            $usuario->confirmado = '1';
            // Eliminamos el token
            $usuario->token = null;
            // Actualizamos el usuario
            $usuario->guardar();
            // Le damos entender al usuario que pasa
            Usuario::setAlerta('exito', 'Cuenta Comprobada correctamente.');
        }

        // Renderizar la vista
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
