<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestión de Pedidos</h1>
        <div class="col-md-4 d-flex align-items-end">
            <button type="button" class="btn btn-primary w-100" onclick="window.location.href='/index.php/index.php?controlador=MateriaPrima&accion=listar'">Menu Inicio</button>
        </div>

        <!-- Formulario para agregar nuevos pedidos -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Agregar Pedido</h4>
            </div>
            <div class="card-body">
                <form id="pedidoForm" method="POST" action="../Controlador/pedidoController.php?action=add">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select id="id_cliente" name="id_cliente" class="form-select" required>
                                <option value="" disabled selected>Seleccione un cliente</option>
                                <?php
                                require_once '../Modelo/pedidoModelo.php';
                                $pedidoModel = new PedidoModel();
                                $clientes = $pedidoModel->obtenerClientes();

                                foreach ($clientes as $cliente) {
                                    echo "<option value='{$cliente['id_cliente']}'>{$cliente['nombre_cliente']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="producto" class="form-label">Producto</label>
                            <select id="id_producto_terminado" name="id_producto_terminado" class="form-select" required>
                                <option value="" disabled selected>Seleccione un producto</option>
                                <?php
                                $productos = $pedidoModel->obtenerProductos();

                                foreach ($productos as $producto) {
                                    echo "<option value='{$producto['id_producto_terminado']}'>{$producto['nombre_producto']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="fecha" class="form-label">Fecha de Pedido</label>
                            <input type="date" id="fecha_pedido" name="fecha_pedido" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha" class="form-label">Fecha de Entrega</label>
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Completado">Completado</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Agregar Pedido</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla para mostrar pedidos existentes -->
        <div class="card">
            <div class="card-header">
                <h4>Lista de Pedidos</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Pedido</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pedidos = $pedidoModel->obtenerPedidos();
                        
                        foreach ($pedidos as $pedido) {
                            echo "<tr>";
                            echo "<td>{$pedido['id_pedido']}</td>";
                            echo "<td>{$pedido['id_cliente']}</td>";
                            echo "<td>{$pedido['id_producto_terminado']}</td>";
                            echo "<td>{$pedido['cantidad_pedida']}</td>";
                            echo "<td>{$pedido['fecha_pedido']}</td>";
                            echo "<td>{$pedido['fecha_entrega']}</td>";
                            echo "<td>{$pedido['estado']}</td>";
                            echo "<td>
                                    <a href='editarPedido.php?id_pedido=" . htmlspecialchars($pedido['id_pedido']) . "' class='btn btn-warning btn-sm'>Editar</a>
                                    <a href='../Controlador/pedidoController.php?action=delete&id={$pedido['id_pedido']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
