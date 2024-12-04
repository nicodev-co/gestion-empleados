<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Empleados Registrados</h3>
        <a href="/empleados/crear" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Empleado
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Fecha de Ingreso</th>
                        <th>Salario</th>
                        <th>Comentarios</th>
                        <th>Género</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?= htmlspecialchars($empleado->getId()); ?></td>
                            <td><?= htmlspecialchars($empleado->getNombres()); ?></td>
                            <td><?= htmlspecialchars($empleado->getApellidos()); ?></td>
                            <td><?= htmlspecialchars($empleado->getEdad()); ?></td>
                            <td><?= htmlspecialchars($empleado->getFechaIngreso()); ?></td>
                            <td><?= htmlspecialchars($empleado->getSalario()); ?></td>
                            <td><?= htmlspecialchars($empleado->getComentarios()); ?></td>
                            <td><?= htmlspecialchars($empleado->getGenero()->getNombre()); ?></td>
                            <td><?= htmlspecialchars($empleado->getDepartamento()->getNombreDepartamento()); ?></td>
                            <td>
                                <a href="/empleados/<?= htmlspecialchars($empleado->getId()); ?>/editar" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                                <buttom type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete">
                                    Eliminar
                                </buttom>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteLabel">Eliminar Empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('delete');
        deleteModal.addEventListener('show.bs.modal', async function(event) {
            const button = event.relatedTarget;
            const empleadoId = button.closest('tr').querySelector('td:first-child').textContent;

            try {
                const response = await fetch(`/empleados/${empleadoId}`);
                const data = await response.json();
                const empleado = data.data;

                const modalBody = deleteModal.querySelector('.modal-body');
                modalBody.innerHTML = `
                    <div class="alert alert-warning" role="alert">
                        ¿Está seguro que desea eliminar al empleado <strong>${empleado.nombres} ${empleado.apellidos}</strong>?
                    </div>
                `;

                const deleteButton = deleteModal.querySelector('.btn-danger');
                deleteButton.onclick = async function() {
                    await fetch(`/empleados/${empleadoId}`, {
                        method: 'DELETE'
                    });
                    location.reload();
                };
            } catch (error) {
                console.error('Error fetching empleado:', error);
            }
        });
    });
</script>