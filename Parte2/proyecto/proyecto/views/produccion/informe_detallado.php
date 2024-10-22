<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Detallado de Producción</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <script>
        function printPDF() {
            window.print(); // Abrirá el diálogo de impresión del navegador
        }
    </script>
    <style>
        .table th, .table td {
            border-right: 1px solid #dee2e6; /* Línea vertical */
        }
        .table th:last-child, .table td:last-child {
            border-right: none; /* Sin línea en la última columna */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Informe Detallado de Producción: <?= htmlspecialchars($produccion['nombre_producto']); ?></h1>
        
        <p><strong>Cantidad Producida:</strong> <?= htmlspecialchars($produccion['cantidad_producida']); ?></p>
        <p><strong>Unidad de Producción:</strong> <?= htmlspecialchars($produccion['nombre_unidad']); ?></p>
        <p><strong>Fecha de Inicio:</strong> <?= htmlspecialchars($produccion['fecha_inicio']); ?></p>
        <p><strong>Encargado:</strong> <?= htmlspecialchars($produccion['nombre_encargado']); ?></p>
        <p><strong>Fecha de Finalización:</strong> <?= ($produccion['estado'] === 'Completada') ? htmlspecialchars($produccion['fecha_fin']) : 'N/A'; ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($produccion['estado']); ?></p>

        <h2>Tareas Asociadas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Empleado</th>
                    <th>Unidad de Producción</th>
                    <th>Estado</th>
                    <th>Fecha de Asignación</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($produccion['tareas']) && !empty($produccion['tareas'])): ?>
                    <?php foreach ($produccion['tareas'] as $tarea): ?>
                        <tr>
                            <td><?= htmlspecialchars($tarea['nombre_tarea']); ?></td>
                            <td><?= htmlspecialchars($tarea['nombre_empleado']); ?></td>
                            <td><?= htmlspecialchars($tarea['nombre_unidad']); ?></td>
                            <td><?= htmlspecialchars($tarea['estado']); ?></td>
                            <td><?= htmlspecialchars($tarea['fecha_asignacion']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay tareas asociadas a esta producción.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <button class="btn btn-primary mt-3" onclick="printPDF()">Descargar PDF</button>
        <br>
        <br>
        <a href="/produccion/generar_informe" class="btn btn-secondary">Volver al Informe General</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>