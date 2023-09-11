<?php

class AddController
{
    public function agregarEquipo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = $_POST['marca'] ?? '';
            $placa = $_POST['placa'] ?? '';

            if (!empty($marca) && !empty($placa)) {
                try {
                    $equipo = new Equipo($marca, $placa);
                    $equipo->continuarEquipo();
                } catch (Exception $e) {
                    echo "Error al agregar vehiculo: " . $e->getMessage();
                }
            } else {
                echo "Error: Debes completar todos los campos.";
            }
        }
    }
}
