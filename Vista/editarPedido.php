<?php
require_once '../Modelo/pedidoModelo.php';

$pedidoModel = new PedidoModel();
$id_pedido = $_GET['id_pedido'] ?? null;

if ($id_pedido) {
    $pedido = $pedidoModel->obtenerPedidoPorId($id_pedido); // Asegúrate de tener este método en tu modelo
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Pedido</h1>
        <form method="POST" action="../Controlador/pedidoController.php?action=edit">
            <input type="hidden" name="edit_id" value="<?php echo $pedido['id_pedido']; ?>">
            <div class="mb-3">
                <label for="edit_cliente" class="form-label">Cliente</label>
                <select id="edit_cliente" name="edit_cliente" class="form-select" required>
                    <option value="" disabled>Seleccione un cliente</option>
                    <?php
                    $clientes = $pedidoModel->obtenerClientes();
                    foreach ($clientes as $cliente) {
                        $selected = $cliente['id_cliente'] == $pedido['id_cliente'] ? 'selected' : '';
                        echo "<option value='{$cliente['id_cliente']}' $selected>{$cliente['nombre_cliente']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="edit_producto" class="form-label">Producto</label>
                <select id="edit_producto" name="edit_producto" class="form-select" required>
                    <option value="" disabled>Seleccione un producto</option>
                    <?php
                    $productos = $pedidoModel->obtenerProductos();
                    foreach ($productos as $producto) {
                        $selected = $producto['id_producto_terminado'] == $pedido['id_producto_terminado'] ? 'selected' : '';
                        echo "<option value='{$producto['id_producto_terminado']}' $selected>{$producto['nombre_producto']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="edit_cantidad" class="form-label">Cantidad</label>
                <input type="number" id="edit_cantidad" name="edit_cantidad" class="form-control" value="<?php echo $pedido['cantidad_pedida']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_fecha_pedido" class="form-label">Fecha de Pedido</label>
                <input type="date" id="edit_fecha_pedido" name="edit_fecha_pedido" class="form-control" value="<?php echo $pedido['fecha_pedido']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_fecha_entrega" class="form-label">Fecha de Entrega</label>
                <input type="date" id="edit_fecha_entrega" name="edit_fecha_entrega" class="form-control" value="<?php echo $pedido['fecha_entrega']; ?>" required>
            </div>
            <div class="mb-3">
    <label for="edit_estado" class="form-label">Estado</label>
    <select id="edit_estado" name="edit_estado" class="form-select" required>
        <option value="Pendiente" <?php echo (isset($pedido['estado']) && $pedido['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="En Proceso" <?php echo (isset($pedido['estado']) && $pedido['estado'] == 'En Proceso') ? 'selected' : ''; ?>>En Proceso</option>
        <option value="Completado" <?php echo (isset($pedido['estado']) && $pedido['estado'] == 'Completado') ? 'selected' : ''; ?>>Completado</option>
    </select>
</div>       
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="../Vista/pedido.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
