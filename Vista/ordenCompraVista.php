<?php ob_start(); ?>
<h1 class="text-center">Órdenes de Compra Generadas</h1>
<!-- Vista/ordenCompraVista.php -->
<!-- Tabla para mostrar las órdenes de compra generadas -->
<?php if (!empty($ordenes)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Orden</th>
                    <th>Código de Materia Prima</th>
                    <th>Cantidad Pedida</th>
                    <th>Fecha de Orden</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordenes as $orden): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orden['id_orden_compra']); ?></td>
                        <td><?php echo htmlspecialchars($orden['codigo_materia_prima']); ?></td>
                        <td><?php echo htmlspecialchars($orden['cantidad_pedida']); ?></td>
                        <td><?php echo htmlspecialchars($orden['fecha_orden']); ?></td>
                        <td><?php echo htmlspecialchars($orden['estado']); ?></td>
                        <td>
                            <?php if ($orden['estado'] === 'Pendiente'): ?>
                                <a href="index.php?accion=confirmarOrden&id=<?php echo $orden['id_orden_compra']; ?>" class="btn btn-success btn-sm">Confirmar</a>
                            <?php else: ?>
                                Confirmada
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-4">
        <strong>¡Atención!</strong> No hay órdenes de compra generadas.
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
