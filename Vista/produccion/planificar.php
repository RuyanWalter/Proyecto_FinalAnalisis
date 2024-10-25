<!DOCTYPE html>
<!-- Vista/produccion/planificar.php-->
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
                <select id="materia_prima" name="materia_prima" class="form-select" required onchange="actualizarCodigoMateriaPrima()">
                    <?php foreach ($materiasPrimas as $materia): ?>
                        <option value="<?= htmlspecialchars($materia['codigo_materia_prima']); ?>" data-codigo="<?= htmlspecialchars($materia['codigo_materia_prima']); ?>">
                            <?= htmlspecialchars($materia['nombre_materia_prima']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="codigo_materia_prima" class="form-label">Código de Materia Prima:</label>
                <input type="text" id="codigo_materia_prima" name="codigo_materia_prima" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="cantidad_materia_prima" class="form-label">Cantidad de Materia Prima a Usar:</label>
                <input type="number" id="cantidad_materia_prima" name="cantidad_materia_prima" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Responsable:</label>
                <select id="usuario" name="usuario" class="form-select" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= htmlspecialchars($usuario['id_usuario']); ?>"><?= htmlspecialchars($usuario['nombre_usuario']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Nueva Producción</button>
        </form>

        <a href="/produccion/generar_informe" class="btn btn-secondary mt-3">Ir a Informe General</a>
        <a class="btn btn-secondary mt-3" href="/index.php?controlador=MateriaPrima&accion=listar">Ir a Registro de Materia Prima</a>
    </div>

    <script>
        function actualizarCodigoMateriaPrima() {
            const materiaPrimaSelect = document.getElementById('materia_prima');
            const selectedOption = materiaPrimaSelect.options[materiaPrimaSelect.selectedIndex];
            const codigoMateriaPrima = selectedOption.getAttribute('data-codigo');
            document.getElementById('codigo_materia_prima').value = codigoMateriaPrima;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
