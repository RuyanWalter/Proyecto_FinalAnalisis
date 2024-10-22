<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planificar Producción</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Planificar Producción</h1>
        <form method="POST" action="/produccion/planificar" class="mt-3">
            <div class="mb-3">
                <label for="producto" class="form-label">Producto:</label>
                <input type="text" id="producto" name="producto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="unidad" class="form-label">Unidad de Producción:</label>
                <select id="unidad" name="unidad" class="form-select" required>
                    <?php foreach ($unidades as $unidad): ?>
                        <option value="<?= htmlspecialchars($unidad['id_unidad']); ?>"><?= htmlspecialchars($unidad['nombre_unidad']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="materia_prima" class="form-label">Materia Prima:</label>
                <select id="materia_prima" name="materia_prima" class="form-select" required>
                    <?php foreach ($materiasPrimas as $materia): ?>
                        <option value="<?= htmlspecialchars($materia['id_materia_prima']); ?>"><?= htmlspecialchars($materia['nombre_materia_prima']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Responsable:</label>
                <select id="usuario" name="usuario" class="form-select" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= htmlspecialchars($usuario['id_usuario']); ?>"><?= htmlspecialchars($usuario['nombre_usuario']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Producción</button>
        </form>

        <a href="/produccion/generar_informe" class="btn btn-secondary mt-3">Volver al Informe General</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>