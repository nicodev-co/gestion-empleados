<?php

namespace Models;

use Core\Db;
use PDO;
use PDOException;

class Genero
{
    public function __construct(
        private int $id,
        private string $nombre
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Obtiene todos los registros de la tabla 'generos'.
     *
     * @return array Arreglo de objetos de la clase Genero.
     * @throws PDOException Si ocurre un error al obtener los géneros.
     */
    public static function getAll(): array
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM generos');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function ($genero) {
                return new self((int) $genero['id'], $genero['nombre']);
            }, $result);
        } catch (PDOException $e) {
            throw new PDOException('Error al obetener generos: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene un género por su ID.
     *
     * @param int $id El ID del género a obtener.
     * @return Genero|null El objeto Genero si se encuentra, o null si no se encuentra.
     * @throws PDOException Si ocurre un error al realizar la consulta a la base de datos.
     */
    public static function getById(int $id): ?Genero
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare('SELECT * FROM generos WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return new self((int) $result['id'], $result['nombre']);
        } catch (PDOException $e) {
            throw new PDOException('Error al obtener el género: ' . $e->getMessage());
        }
    }
}
