<?php

namespace Models;

use Core\Db;
use PDO;
use PDOException;

class Departamento
{
    public function __construct(private int $id, private string $nombre_departamento) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombreDepartamento(): string
    {
        return $this->nombre_departamento;
    }

    /**
     * Recupera todos los departamentos de la base de datos.
     *
     * @return array Un array de objetos Departamento.
     * @throws PDOException Si hay un error al obtener los departamentos.
     */
    public static function getAll(): array
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM departamentos');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function ($departamento) {
                return new self((int) $departamento['id'], $departamento['nombre_departamento']);
            }, $result);
        } catch (PDOException $e) {
            throw new PDOException('Error al obtener departamentos: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene un departamento por su ID.
     *
     * @param int $id El ID del departamento a obtener.
     * @return ?Departamento El objeto Departamento si se encuentra, o null si no se encuentra.
     * @throws PDOException Si ocurre un error al obtener el departamento desde la base de datos.
     */
    public static function getById(int $id): ?Departamento
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM departamentos WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return new self((int) $result['id'], $result['nombre_departamento']);
        } catch (PDOException $e) {
            throw new PDOException('Error al obtener el departamento: ' . $e->getMessage());
        }
    }
}
