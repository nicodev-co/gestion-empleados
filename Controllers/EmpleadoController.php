<?php

namespace Controllers;

use Models\Departamento;
use Models\Empleado;
use Models\Genero;

class EmpleadoController
{
    public function index()
    {
        $empleados = Empleado::getAll();
        ob_start();
        include 'views/empleados/index.php';
        $contenido = ob_get_clean();
        include 'views/layout.php';
    }

    public function create()
    {
        $tituloSeccion = 'Crear Empleado';
        $empleado = new Empleado();
        $generos = Genero::getAll();
        $departamentos = Departamento::getAll();
        ob_start();
        include __DIR__ . '/../views/empleados/create.php';
        $contenido = ob_get_clean();
        include  __DIR__ . '/../views/layout.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'edad' => $_POST['edad'],
                'fecha_ingreso' => $_POST['fecha_ingreso'],
                'comentarios' => $_POST['comentarios'],
                'genero_id' => $_POST['genero_id'],
                'departamento_id' => $_POST['departamento_id'],
                'salario' => $_POST['salario']
            ];
            Empleado::create($data);
            $_SESSION['mensaje'] = 'Empleado creado exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
            header('Location: /');
        } else {
            require 'views/empleados/create.php';
        }
    }

    public function show($id)
    {
        header('Content-Type: application/json');
        try {
            $empleado = Empleado::getById($id);
            if ($empleado) {
                $empleadoData = [
                    'id' => $empleado->getId(),
                    'nombres' => $empleado->getNombres(),
                    'apellidos' => $empleado->getApellidos(),
                    'edad' => $empleado->getEdad(),
                    'fecha_ingreso' => $empleado->getFechaIngreso(),
                    'comentarios' => $empleado->getComentarios(),
                    'genero_id' => $empleado->getGeneroId(),
                    'departamento_id' => $empleado->getDepartamentoId(),
                    'salario' => $empleado->getSalario()
                ];
                echo json_encode(['success' => true, 'data' => $empleadoData]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Empleado no encontrado']);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error del servidor', 'error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $tituloSeccion = 'Editar Empleado';
        $empleado = Empleado::getById($id);
        $generos = Genero::getAll();
        $departamentos = Departamento::getAll();
        ob_start();
        include 'views/empleados/create.php';
        $contenido = ob_get_clean();
        include 'views/layout.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $empleado = Empleado::getById($_POST['id']);
            if ($empleado) {
                $data = [
                    'nombres' => $_POST['nombres'],
                    'apellidos' => $_POST['apellidos'],
                    'edad' => $_POST['edad'],
                    'fecha_ingreso' => $_POST['fecha_ingreso'],
                    'comentarios' => $_POST['comentarios'],
                    'genero_id' => $_POST['genero_id'],
                    'departamento_id' => $_POST['departamento_id'],
                    'salario' => $_POST['salario']
                ];
                Empleado::update($empleado->getId(),$data);
                $_SESSION['mensaje'] = 'Empleado actualizado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
                header('Location: /');
            } else {
                $_SESSION['mensaje'] = 'Empleado no encontrado';
                $_SESSION['tipo_mensaje'] = 'error';
                header('Location: /');
            }
        } else {
            require 'views/empleados/create.php';
        }
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            try {
                $empleado = Empleado::getById($id);
                if ($empleado) {
                    Empleado::delete($id);
                    $_SESSION['mensaje'] = 'Empleado eliminado exitosamente';
                    $_SESSION['tipo_mensaje'] = 'success';
                    echo json_encode(['success' => true, 'message' => 'Empleado eliminado exitosamente']);
                } else {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'message' => 'Empleado no encontrado']);
                }
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error del servidor', 'error' => $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }
}
