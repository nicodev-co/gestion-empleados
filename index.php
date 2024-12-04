
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {

    $file = __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';

    if (file_exists($file)) {
        require_once $file;
        return;
    }
});


require_once __DIR__ . '/routes/web.php';
