<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'admin',
        'confirmado',
        'token'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensaje de valiacion para la creacion de la cuenta
    public function validarNuevaCuenta()
    {
        switch (true) {
            case $this->validar_nombre_apellido($this->nombre, 'Nombre'):
                break;
            case $this->validar_nombre_apellido($this->apellido, 'Apellido'):
                break;
            case empty($this->telefono):
                self::$alertas['error'][] = 'El numero telefonico es Obligatorio';
                break;
            case !preg_match('/^[0-9]{8}$/', $this->telefono):
                self::$alertas['error'][] = 'El numero de telefono no es Valido';
                break;
            case $this->validarEmail():
                break;
            case $this->validarPassword($this->password):
                break;
        }

        return self::$alertas;
    }

    public function validarLogin()
    {
        switch (true) {
            case $this->validarEmail():
                break;
            case empty($this->password):
                self::$alertas['error'][] = 'El Password es Obligatorio.';
                break;
        }
        return self::$alertas;
    }

    public function validarEmail()
    {
        switch (true) {
            case empty($this->email):
                self::$alertas['error'][] = 'El Email es Obligatorio.';
                break;
            case strlen($this->email) > 255:
                self::$alertas['error'][] = 'El Email no puede tener más de 255 caracteres.';
                break;
            case !filter_var($this->email, FILTER_VALIDATE_EMAIL):
                self::$alertas['error'][] = 'El Email no es Valido.';
                break;
        }
        return self::$alertas;
    }

    public function validarPassword($password)
    {
        switch (true) {
            case empty($password):
                self::$alertas['error'][] = 'El Password es Obligatorio.';
                break;
            case strlen($password) < 8:
                self::$alertas['error'][] = 'El Password debe tener al menos 8 caracteres.';
                break;
            case !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password):
                self::$alertas['error'][] = 'La Contraseña debe contener al menos una letra mayúscula y una letra minúscula.';
                break;
            case !preg_match('/\d/', $password):
                self::$alertas['error'][] = 'La Contraseña debe contener al menos un número.';
                break;
            case !preg_match('/[^a-zA-Z\d\s]/', $password):
                self::$alertas['error'][] = 'La Contraseña debe contener al menos un carácter especial.';
                break;
        }
        return self::$alertas;
    }

    public function validar_nombre_apellido($campo, $nombre_campo)
    {
        // Definir límites de caracteres
        $limite_caracteres = 60;

        switch (true) {
            case empty($campo):
                self::$alertas['error'][] = "El $nombre_campo es Obligatorio";
                break;
            case strlen($campo) > $limite_caracteres:
                self::$alertas['error'][] = "El $nombre_campo no puede tener más de $limite_caracteres caracteres.";
                break;
            case !preg_match('/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/', $campo):
                self::$alertas['error'][] = "El $nombre_campo solo debe contener letras y espacios.";
                break;
        }
        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado.';
        }
        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password)
    {
        $resultado = password_verify($password, $this->password);

        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña incorrecta o tu cuenta aun no ha sido activada.';
        } else {
            return true;
        }
    }
}
