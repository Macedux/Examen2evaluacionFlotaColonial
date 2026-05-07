<?php

spl_autoload_register(function ($class) {
    $paths = ['models/', 'controllers/'];//pregunta trampa! no importa el orden puede llamarse primero a controller y luego a model pero hace el doble de pasos

    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
