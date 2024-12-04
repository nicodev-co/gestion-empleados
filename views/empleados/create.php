<form action="/empleados" method="post" class="needs-validation" novalidate>
    <?php if ($empleado->getId()): ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= $empleado->getId() ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="nombres" class="form-label">Nombres:</label>
        <input type="text" id="nombres" name="nombres" class="form-control" value="<?= htmlspecialchars($empleado->getNombres()) ?>" required>
        <div class="invalid-feedback">
            Por favor ingrese los nombres.
        </div>
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?= htmlspecialchars($empleado->getApellidos()) ?>" required>
        <div class="invalid-feedback">
            Por favor ingrese los apellidos.
        </div>
    </div>

    <div class="mb-3">
        <label for="edad" class="form-label">Edad:</label>
        <input type="number" id="edad" name="edad" class="form-control" value="<?= htmlspecialchars($empleado->getEdad()) ?>" required>
        <div class="invalid-feedback">
            Por favor ingrese la edad.
        </div>
    </div>

    <div class="mb-3">
        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" value="<?= htmlspecialchars($empleado->getFechaIngreso()) ?>" required>
        <div class="invalid-feedback">
            Por favor ingrese la fecha de ingreso.
        </div>
    </div>

    <div class="mb-3">
        <label for="salario" class="form-label">Salario:</label>
        <input type="number" id="salario" name="salario" class="form-control" value="<?= htmlspecialchars($empleado->getSalario()) ?>" required>
        <div class="invalid-feedback">
            Por favor ingrese el salario.
        </div>
    </div>

    <div class="mb-3">
        <label for="comentarios" class="form-label">Comentarios:</label>
        <textarea id="comentarios" name="comentarios" class="form-control"><?= $empleado->getComentarios() ?></textarea>
    </div>

    <div class="mb-3">
        <label for="genero" class="form-label">Género:</label>
        <select id="genero" name="genero_id" class="form-select" required>
            <option value="">- seleccionar -</option>
            <?php foreach ($generos as $genero): ?>
                <option <?= $genero->getId() == $empleado->getGeneroId() ? 'selected' : '' ?>
                    value="<?= htmlspecialchars($genero->getId()) ?>"><?= htmlspecialchars($genero->getNombre()) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            Por favor ingrese el genero.
        </div>
    </div>

    <div class="mb-3">
        <label for="departamento" class="form-label">Departamento:</label>
        <select id="departamento" name="departamento_id" class="form-select" required>
            <option value="">- seleccionar -</option>
            <?php foreach ($departamentos as $departamento): ?>
                <option <?= $departamento->getId() == $empleado->getDepartamentoId() ? 'selected' : '' ?>
                    value="<?= htmlspecialchars($departamento->getId()) ?>"><?= htmlspecialchars($departamento->getNombreDepartamento()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>