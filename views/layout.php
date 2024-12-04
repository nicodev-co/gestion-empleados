<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?? 'Sistema de Empleados' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" rel="stylesheet">
    <link href="/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar / Menú de navegación -->
            <div class="col-md-2 sidebar">
                <h3 class="text-center mb-4">Gestión Empleados</h3>
                <nav class="nav flex-column">
                    <a class="nav-link" href="/">
                        <i class="fas fa-users me-1"></i> Listado Empleados
                    </a>
                    <a class="nav-link" href="/empleados/crear">
                        <i class="fas fa-user-plus me-1"></i> Nuevo Empleado
                    </a>
                </nav>
            </div>

            <!-- Área de Contenido -->
            <div class="col-md-10 p-3">
                <div class="container">
                    <!-- Header -->
                    <header class="mb-4 d-flex justify-content-between align-items-center">
                        <h1><?= $tituloSeccion ?? 'Panel Principal' ?></h1>
                        <div class="user-info">
                            <span class="text-muted">
                                <i class="fas fa-user"></i>
                                <?= $_SESSION['usuario'] ?? 'Usuario Invitado' ?>
                            </span>
                        </div>
                    </header>

                    <!-- Mensajes flash (alertas) -->
                    <?php if (isset($_SESSION['mensaje'])): ?>
                        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['mensaje'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['mensaje']); ?>
                    <?php endif; ?>

                    <!-- Contenido dinámico -->


                    <?= $contenido ?>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>

</html>