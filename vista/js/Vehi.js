// editModal.js
document.addEventListener('DOMContentLoaded', function () {
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
});
