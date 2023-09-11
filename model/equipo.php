<?php

include '../controller/conexion.php';

class equipo
{
    private $id;
    private $nombre;
    private $pais;

    public function __construct($nombre	, $pais, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pais = $pais;
    }

    public function continuarEquipo()
    {
        $pdo = new Connection();
        try {
            $sql = "INSERT INTO vehiculo1 (nombre, pais) VALUES ('$this->nombre', '$this->pais')";
            $query = $pdo->prepare($sql);
            $query->execute();
            $lastInsertId = $pdo->lastInsertId();
            echo "equipo creado con ID: " . $lastInsertId;
            
        } catch (Exception $e) {
            echo "Error en crear equipo: " . $e->getMessage();
            
        }
    }

    public function actualizarEquipo()
    {
        $pdo = new Connection();
        try {
            $sql = "UPDATE vehiculo1 SET pais = :pais, nombre = :nombre WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':pais' => $this->pais,
                ':id' => $this->id
            ));
            header("Location: ../vista/listar.php");
            exit();
        } catch (Exception $e) {
            echo "Error en actualizar vehivulo: " . $e->getMessage();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
            $id = $_POST['edit_id'];
            $nombre = $_POST['edit_nombre'];
            $pais = $_POST['edit_pais'];
        
            try {
                $pdo = new Connection();
                $sql = "UPDATE vehiculo1 SET pais = :pais, nombre = :nombre WHERE id = :id";
                $query = $pdo->prepare($sql);
                $query->execute(array(
                    ':nombre' => $nombre,
                    ':pais' => $pais,
                    ':id' => $id
                ));
                header("Location: ../vista/listar.php"); // Redirige después de la actualización
                exit();
            } catch (Exception $e) {
                echo "Error en actualizar vehículo: " . $e->getMessage();
            }
        }

    }
    public function eliminarEquipo()
    {
        $pdo = new Connection();
        try {
            $sql = "DELETE FROM vehiculo1 WHERE id = $this->id";
            $query = $pdo->prepare($sql);
            $query->execute();
            echo "Equipo eliminado correctamente.";
        } catch (Exception $e) {
            echo "Error en eliminar equipo: " . $e->getMessage();
        }
    }

    public function listarEquipo()
    {
        $pdo = new Connection();
        try {
            $sql = "SELECT * FROM vehiculo1";
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar equipos: " . $e->getMessage();
            return array();
        }
    }

    public function listarEquipos()
    {
        $pdo = new Connection();
        try {
            $sql = "SELECT * FROM vehiculo1";
            $query = $pdo->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar equipos: " . $e->getMessage();
            return array();
        }
    }
    
    // Métodos para poder usar los Set en el archivo listar php
    public function setMarca($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPlaca($pais)
    {
        $this->pais = $pais;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    
}
?>
