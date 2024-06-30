<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        isAdmin();
        // Fecha Actual Servidor
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        // Consultar la base de datos
        $consulta = "";
        $consulta .= "SELECT";
        $consulta .= " c.id, ";
        $consulta .= " c.hora,";
        $consulta .= " concat(u.nombre, ' ', u.apellido) AS cliente,";
        $consulta .= " u.email,";
        $consulta .= " u.telefono,";
        $consulta .= " s.nombre AS servicio,";
        $consulta .= " s.precio";
        $consulta .= " FROM";
        $consulta .= " citas c";
        $consulta .= " LEFT OUTER JOIN usuarios u ON";
        $consulta .= " c.usuario_id = u.id";
        $consulta .= " LEFT OUTER JOIN citas_servicios cs ON";
        $consulta .= " cs.cita_id = c.id";
        $consulta .= " LEFT OUTER JOIN servicios s ON";
        $consulta .= " s.id = cs.servicio_id";
        $consulta .= " WHERE fecha = '{$fecha}';";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
