<?php
include ('../model/equipo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['nombre'] ?? '';
    $placa = $_POST['pais'] ?? '';
    $id = $_POST['id'] ?? null;

    $equipo = new Equipo($marca, $placa, $id);

    if (isset($_POST['continuar'])) {
        $equipo->continuarEquipo();
    } elseif (isset($_POST['actualizar'])) {
        $equipo->actualizarEquipo();
    } elseif (isset($_POST['eliminar'])) {
        $equipo->eliminarEquipo();
    }
}
if (isset($_POST['actualizar'])) {
    $edit_id = $_POST['edit_id'];
    $edit_nombre = $_POST['edit_nombre'];
    $edit_pais = $_POST['edit_pais'];

    // Realiza la conexión a la base de datos y ejecuta la consulta de actualización
    $pdo = new Connection();
    try {
        $sql = "UPDATE vehiculo1 SET pais = :pais, nombre = :nombre WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(array(
            ':nombre' => $edit_nombre,
            ':pais' => $edit_pais,
            ':id' => $edit_id
        ));

        // Redirige a la página de listado después de la actualización exitosa
        header("Location: ../vista/listar.php");
        exit();
    } catch (Exception $e) {
        echo "Error en actualizar vehiculo: " . $e->getMessage();
    }
}

?>
