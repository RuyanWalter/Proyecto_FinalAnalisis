<?php ob_start(); ?>
<h1 class="text-center">Inventario de Materia Prima</h1>

<!-- Tabla para mostrar el inventario completo -->
<?php if (!empty($inventario)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Unidad de Medida</th>
                    <th>Total Ingreso</th>
                    <th>Total Egreso</th>
                    <th>Saldo Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventario as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['codigo_materia_prima']); ?></td>
                        <td><?php echo htmlspecialchars($item['nombre_materia_prima']); ?></td>
                        <td><?php echo htmlspecialchars($item['unidad_medida']); ?></td>
                        <td><?php echo htmlspecialchars($item['total_ingreso']); ?></td>
                        <td><?php echo htmlspecialchars($item['total_egreso']); ?></td>
                        <td><?php echo htmlspecialchars($item['saldo_actual']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-4">
        <strong>¡Atención!</strong> No hay inventario registrado.
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
