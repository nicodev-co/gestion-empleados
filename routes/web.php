<?php

use Controllers\EmpleadoController;
use Core\Route;

Route::add('GET', '/', function() {
    $controller = new EmpleadoController();
    $controller->index();
});

Route::add('GET', '/empleados/crear', function() {
    $controller = new EmpleadoController();
    $controller->create();
});

Route::add('GET', '/empleados/{id}', function($id) {
    $controller = new EmpleadoController();
    $controller->show($id);
});

Route::add('GET', '/empleados/{id}/editar', function($id) {
    $controller = new EmpleadoController();
    $controller->edit($id);
});

Route::add('POST', '/empleados', function() {
    $controller = new EmpleadoController();
    $controller->store();
});

Route::add('PUT', '/empleados', function() {
    $controller = new EmpleadoController();
    $controller->update();
});

Route::add('DELETE', '/empleados/{id}', function($id) {
    $controller = new EmpleadoController();
    $controller->delete($id);
});

Route::dispatch();