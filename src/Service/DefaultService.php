<?php

namespace App\Service;


define('PI', 3.1416);
class DefaultService
{

    public function obtenerPi(): string
    {

        if(defined('PI')){
            return "Definimos PI en: " . PI;
        }
        return PI;
    }

    public function obtenerVersionPhp(): string
    {
        return 'La versión de PHP es: ' . PHP_VERSION;
    }

    public function obtenerSO(): string
    {
        return 'El SO es: ' . PHP_OS . ' de la familia: ' . PHP_OS_FAMILY;
    }

    public function obtenerPathExtensionPhp(): string
    {
        return 'Las rutas de las extensiones php: ' . PHP_EXTENSION_DIR;
    }

}