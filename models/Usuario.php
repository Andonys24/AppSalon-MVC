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
            case empty($this->nombre):
                self::$alertas['error'][] = 'El nombre es Obligatorio';
                break;
            case empty($this->apellido):
                self::$alertas['error'][] = 'El apellido es Obligatorio';
                break;
            case empty($this->telefono):
                self::$alertas['error'][] = 'El numero telefonico es Obligatorio';
                break;
            case !preg_match('/^[0-9]{8}$/', $this->telefono):
                self::$alertas['error'][] = 'El numero de telefono no es Valido';
                break;
            case empty($this->email):
                self::$alertas['error'][] = 'El E-mail es Obligatorio';
                break;
            case !filter_var($this->email, FILTER_VALIDATE_EMAIL):
                self::$alertas['error'][] = 'El E-mail no es Valido';
                break;
            case empty($this->password):
                self::$alertas['error'][] = 'La contraseña es Obligatorio';
                break;
            case !validarLongitudMinima($this->password):
                self::$alertas['error'][] = 'La contraseña debe tener al menos 8 caracteres';
                break;
            case !validarLetrasMayusculasMinusculas($this->password):
                self::$alertas['error'][] = 'La contraseña debe incluir al menos una letra mayúscula y una letra minúscula';
                break;
            case !validarNumerosCaracteresEspeciales($this->password):
                self::$alertas['error'][] = 'La contraseña debe incluir al menos un número y un carácter especial (@$!%*?&)';
                break;
        }

        return self::$alertas;
    }

    public function validarLogin()
    {
        switch (true) {
            case empty($this->email):
                self::$alertas['error'][] = 'El E-mail es Obligatorio';
                break;
            case empty($this->password):
                self::$alertas['error'][] = 'La contraseña es Obligatorio';
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

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);
        
        if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña incorrecta o tu cuenta aun no ha sido activada.';
        } else{
            return true;
        }
    }
}
