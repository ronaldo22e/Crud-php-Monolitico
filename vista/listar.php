<?php
include '../model/equipo.php';

function mostrarVista()
{
    $equipo = new equipo(null, null);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['continuar'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];

            $equipo->setId($id);
            $equipo->setNombre($nombre);
            $equipo->setPais($pais);

            if (isset($_POST['actualizar'])) {
                $equipo->actualizarEquipo();
            } else {
                $equipo->continuarEquipo();
            }
        }

        if (isset($_POST['eliminar'])) {
            $id = $_POST['id'];
            $equipo->setId($id);
            $equipo->eliminarEquipo();
        }
    }

    $equipos = $equipo->listarEquipos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vehiculo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="editModal.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h1>Vehiculos</h1>
       
    </div>

    <div class="container mt-5">
        <h2>Listado de vehiculos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($equipos as $equipo) {
                    echo "<tr>";
                    echo "<td>{$equipo['id']}</td>";
                    echo "<td>{$equipo['nombre']}</td>";
                    echo "<td>{$equipo['pais']}</td>";
                    echo "<td><a href=\"#\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\" data-id=\"{$equipo['id']}\" data-nombre=\"{$equipo['nombre']}\" data-pais=\"{$equipo['pais']}\">Editar</a></td>";
                    echo "<td>
                            <form method=\"post\">
                                <input type=\"hidden\" name=\"id\" value=\"{$equipo['id']}\">
                                <input type=\"submit\" name=\"eliminar\" value=\"Eliminar\" class=\"btn btn-danger\">
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

   
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controller/appController.php" method="post">
                        <div class="mb-3">
                            <label for="edit_id" class="form-label">ID del vehiculo</label>
                            <input type="text" name="edit_id" id="edit_id" class="form-control" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nombre" class="form-label">Nombre del vehiculo</label>
                            <input type="text" name="edit_nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_pais" class="form-label">Placa del vehiculo</label>
                            <input type="text" name="edit_pais" id="edit_pais" class="form-control" required>
                        </div>
                        <!-- Add other fields if needed -->
                        <div class="d-grid gap-2">
                            <input type="submit" name="actualizar" value="Actualizar Equipo" class="btn btn-outline-success"  >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

   
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar nuevo vehiculos
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controller/appController.php" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Marca del vehiculos</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="pais" class="form-label">Placa del vehiculo</label>
                            <input type="text" name="pais" id="pais" class="form-control" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <input type="submit" name="continuar" value="Continuar Equipo" class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript to populate the Edit modal with data
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const pais = button.getAttribute('data-pais');

        const edit_id_input = editModal.querySelector('#edit_id');
        const edit_nombre_input = editModal.querySelector('#edit_nombre');
        const edit_pais_input = editModal.querySelector('#edit_pais');

        edit_id_input.value = id;
        edit_nombre_input.value = nombre;
        edit_pais_input.value = pais;
    });
</script>
<?php
}

mostrarVista();
?>
