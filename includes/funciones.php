<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Funciones para validar contrasenas

// Validar caracteres minimos
function validarLongitudMinima($password)
{
    return strlen($password) >= 8;
}

// Validar de inclusion de letras mayusculas y minusculas
function validarLetrasMayusculasMinusculas($password)
{
    return preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password);
}

// Validacion de numeros y caracteres especiales
function validarNumerosCaracteresEspeciales($password)
{
    return preg_match('/[\d]/', $password) && preg_match('/[@$!%*?&]/', $password);
}