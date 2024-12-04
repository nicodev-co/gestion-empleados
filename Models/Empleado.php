<?php

namespace Models;

use Core\Db;
use PDO;
use PDOException;

class Empleado
{
    private $genero;
    private $departamento;

    public function __construct(
        private int $id = 0,
        private string $nombres = '',
        private string $apellidos = '',
        private int $edad = 18,
        private string $fecha_ingreso = '',
        private ?string $comentarios = null,
        private int $genero_id = 0,
        private int $departamento_id = 0,
        private float $salario = 0.0
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombres(): string
    {
        return $this->nombres;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function getFechaIngreso(): string
    {
        return $this->fecha_ingreso;
    }

    public function getComentarios(): ?string
    {
        return $this->comentarios;
    }

    public function getGeneroId(): int
    {
        return $this->genero_id;
    }

    public function getDepartamentoId(): int
    {
        return $this->departamento_id;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    /**
     * Obtiene el género del empleado.
     *
     * Si el género no está definido, lo busca por el ID de género y lo asigna.
     *
     * @return Genero El género del empleado.
     */
    public function getGenero()
    {
        if (!$this->genero) {
            $this->genero = Genero::getById($this->genero_id);
        }
        return $this->genero;
    }

    /**
     * Obtiene el departamento asociado al empleado.
     *
     * Si el departamento no está cargado, lo busca por su ID y lo asigna.
     *
     * @return Departamento El departamento asociado al empleado.
     */
    public function getDepartamento()
    {
        if (!$this->departamento) {
            $this->departamento = Departamento::getById($this->departamento_id);
        }
        return $this->departamento;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombres(string $nombres): void
    {
        $this->nombres = $nombres;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }

    public function setFechaIngreso(string $fecha_ingreso): void
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    public function setComentarios(?string $comentarios): void
    {
        $this->comentarios = $comentarios;
    }

    public function setGeneroId(int $genero_id): void
    {
        $this->genero_id = $genero_id;
    }

    public function setDepartamentoId(int $departamento_id): void
    {
        $this->departamento_id = $departamento_id;
    }

    public function setSalario(float $salario): void
    {
        $this->salario = $salario;
    }

    public static function getAll()
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM empleados');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function ($empleado) {
                return new self(
                    (int) $empleado['id'],
                    $empleado['nombres'],
                    $empleado['apellidos'],
                    (int) $empleado['edad'],
                    $empleado['fecha_ingreso'],
                    $empleado['comentarios'],
                    (int) $empleado['genero_id'],
                    (int) $empleado['departamento_id'],
                    (float) $empleado['salario']
                );
            }, $result);
        } catch (PDOException $e) {
            throw new PDOException('Error al obtener empleados: ' . $e->getMessage());
        }
    }

    public static function getById($id)
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM empleados WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return new self(
                (int) $result['id'],
                $result['nombres'],
                $result['apellidos'],
                (int) $result['edad'],
                $result['fecha_ingreso'],
                $result['comentarios'],
                (int) $result['genero_id'],
                (int) $result['departamento_id'],
                (float) $result['salario']
            );
        } catch (PDOException $e) {
            throw new PDOException('Error al obtener el empleado: ' . $e->getMessage());
        }
    }

    public static function create($data)
    {
        return self::save(new self(
            0,
            $data['nombres'],
            $data['apellidos'],
            $data['edad'],
            $data['fecha_ingreso'],
            $data['comentarios'],
            $data['genero_id'],
            $data['departamento_id'],
            $data['salario']
        ));
    }

    public static function update($id, $data)
    {
        return self::save(new self(
            $id,
            $data['nombres'],
            $data['apellidos'],
            $data['edad'],
            $data['fecha_ingreso'],
            $data['comentarios'],
            $data['genero_id'],
            $data['departamento_id'],
            $data['salario']
        ));
    }

    private static function save(Empleado $empleado)
    {
        $db = Db::getInstance();
        if ($empleado->getId() === 0) {
            $stmt = $db->prepare('INSERT INTO empleados (nombres, apellidos, edad, fecha_ingreso, comentarios, genero_id, departamento_id, salario) VALUES (:nombres, :apellidos, :edad, :fecha_ingreso, :comentarios, :genero_id, :departamento_id, :salario)');
        } else {
            $stmt = $db->prepare('UPDATE empleados SET nombres = :nombres, apellidos = :apellidos, edad = :edad, fecha_ingreso = :fecha_ingreso, comentarios = :comentarios, genero_id = :genero_id, departamento_id = :departamento_id, salario = :salario WHERE id = :id');
            $stmt->bindParam(':id', $empleado->getId(), PDO::PARAM_INT);
        }

        $stmt->bindParam(':nombres', $empleado->getNombres(), PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $empleado->getApellidos(), PDO::PARAM_STR);
        $stmt->bindParam(':edad', $empleado->getEdad(), PDO::PARAM_INT);
        $stmt->bindParam(':fecha_ingreso', $empleado->getFechaIngreso(), PDO::PARAM_STR);
        $stmt->bindParam(':comentarios', $empleado->getComentarios(), $empleado->getComentarios() === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':genero_id', $empleado->getGeneroId(), PDO::PARAM_INT);
        $stmt->bindParam(':departamento_id', $empleado->getDepartamentoId(), PDO::PARAM_INT);
        $stmt->bindParam(':salario', $empleado->getSalario(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public static function delete($id)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare('DELETE FROM empleados WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
