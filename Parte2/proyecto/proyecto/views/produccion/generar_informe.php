<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Producción</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

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
    <h1>Informe General de Producción</h1>

    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Fecha de Inicio</th>
                    <th>Estado</th>
                    <th>Fecha de Finalización</th>
                    <th>Tareas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producciones as $produccion): ?>
                    <tr>
                        <td><?= htmlspecialchars($produccion['nombre_producto']); ?></td>
                        <td><?= htmlspecialchars($produccion['cantidad_producida']); ?></td>
                        <td><?= htmlspecialchars($produccion['nombre_unidad']); ?></td>
                        <td><?= htmlspecialchars($produccion['fecha_inicio']); ?></td>
                        
                        <td>
                            <?= htmlspecialchars($produccion['estado']); ?>
                            <?php if (Produccion::todasTareasCompletas($produccion['id_produccion'])): ?>
                                <form method="POST" action="/produccion/cambiar_estado" style="display:inline;">
                                    <input type="hidden" name="idProduccion" value="<?= htmlspecialchars($produccion['id_produccion']); ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Actualizar Estado</button>
                                </form>
                            <?php else: ?>
                                <button disabled class="btn btn-secondary btn-sm">No se puede completar (Tareas pendientes)</button>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= ($produccion['estado'] === 'Completada') ? htmlspecialchars($produccion['fecha_fin']) : 'N/A'; ?>
                        </td>

                        <td>
                            <ul>
                                <?php if (isset($produccion['tareas']) && !empty($produccion['tareas'])): ?>
                                    <?php foreach ($produccion['tareas'] as $tarea): ?>
                                        <li>
                                            <?= htmlspecialchars($tarea['nombre_tarea']); ?>
                                            <strong>Estado:</strong> <?= htmlspecialchars($tarea['estado']); ?>
                                            <form method="POST" action="/tarea/eliminar" style="display:inline;">
                                                <input type="hidden" name="idTarea" value="<?= htmlspecialchars($tarea['id_tarea']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                            <form method="POST" action="/tarea/completar" style="display:inline;">
                                                <input type="hidden" name="idTarea" value="<?= htmlspecialchars($tarea['id_tarea']); ?>">
                                                <button type="submit" class="btn btn-success btn-sm">Completar</button>
                                            </form>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>No hay tareas asignadas.</li>
                                <?php endif; ?>
                            </ul>
                        </td>

                        <td>
                            <form action="/produccion/asignar_tarea" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($produccion['id_produccion']); ?>">
                                <button type="submit" class="btn btn-info btn-sm">Asignar Tarea</button>
                            </form>
                            <form action="/produccion/informe_detallado" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $produccion['id_produccion']; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Ver Informe Detallado</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="/produccion/planificar" class="btn btn-secondary mt-3">Volver a Planificar Producción</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>