<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-4">
        <h1>Asignar Tarea a Producción</h1>

        <!-- Mostrar información básica de la producción -->
        <h2>Producción: <?= htmlspecialchars($produccion['nombre_producto']); ?></h2>
        <p><strong>Cantidad a Producir:</strong> <?= htmlspecialchars($produccion['cantidad_producida']); ?></p>
        <p><strong>Unidad de Producción:</strong> <?= htmlspecialchars($produccion['nombre_unidad']); ?></p>

        <!-- Formulario para asignar tarea -->
        <form method="POST" action="/produccion/asignar_tarea" class="mt-3">
            <input type="hidden" name="idProduccion" value="<?= htmlspecialchars($produccion['id_produccion']); ?>">

            <div class="mb-3">
                <label for="nombreTarea" class="form-label">Tarea a Asignar:</label>
                <input type="text" id="nombreTarea" name="nombreTarea" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="empleado" class="form-label">Seleccionar Empleado:</label>
                <select id="empleado" name="empleado" class="form-select">
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?= htmlspecialchars($empleado['id_empleado']); ?>"><?= htmlspecialchars($empleado['nombre_empleado']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="unidadProduccion" class="form-label">Seleccionar Unidad de Producción:</label>
                <select id="unidadProduccion" name="unidadProduccion" class="form-select">
                    <?php foreach ($unidades as $unidad): ?>
                        <option value="<?= htmlspecialchars($unidad['id_unidad']); ?>"><?= htmlspecialchars($unidad['nombre_unidad']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tipoTarea" class="form-label">Tipo de Tarea:</label>
                <select id="tipoTarea" name="tipoTarea" class="form-select">
                    <option value="simple">Simple</option>
                    <option value="compuesta">Compuesta</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Asignar Tarea</button>
        </form>

        <a href="/produccion/generar_informe" class="btn btn-secondary mt-3">Volver al Informe General</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>