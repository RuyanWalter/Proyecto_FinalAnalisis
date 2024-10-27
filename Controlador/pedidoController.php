<?php

require_once '../Modelo/pedidoModelo.php';

$pedidoModel = new PedidoModel();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cliente = $_POST['id_cliente'];
                $producto = $_POST['id_producto_terminado'];
                $cantidad = $_POST['cantidad'];
                $fecha_pedido = $_POST['fecha_pedido'];
                $fecha_entrega =$_POST['fecha_entrega'];
                $estado = $_POST['estado'];

                if ($pedidoModel->agregarPedido($cliente, $producto, $cantidad, $fecha_pedido,$fecha_entrega, $estado,'2')) {
                    header('Location: ../Vista/pedido.php');
                } else {
                    echo "Error al agregar el pedido.";
                }
            }
            break;

        case 'edit':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    header('Content-Type: application/json'); 
                    $id = $_POST['edit_id'];
                    $cliente = $_POST['edit_cliente'];
                    $producto = $_POST['edit_producto'];
                    $cantidad = $_POST['edit_cantidad'];
                    $fecha_pedido = $_POST['edit_fecha_pedido'];
                    $fecha_entrega = $_POST['edit_fecha_entrega'];
                    $estado = $_POST['edit_estado'];
    
                    // Llamar al modelo para editar el pedido
                    $result = $pedidoModel->editarPedido($id, $cliente, $producto, $cantidad, $fecha_pedido, $fecha_entrega, $estado);
    
                    // Devolver respuesta en formato JSON
                    if ($result) {
                        header('Location: ../Vista/pedido.php');
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al actualizar el pedido.']);
                    }
                    exit; // Terminar la ejecución después de enviar la respuesta
                }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($pedidoModel->eliminarPedido($id)) {
                    header('Location: ../Vista/pedido.php');
                } else {
                    echo "Error al eliminar el pedido.";
                }
            }
            break;

        default:
            header('Location: ../Vista/pedido.php');
            break;
    }
}
