<?php

class PedidoModel {
    private $db;

    public function __construct() {
    require_once '../Configuracion/Database.php';
    $this->db = Database::getConnection(); // Usar el método estático
    
    }


    // Método para obtener todos los pedidos
    public function obtenerPedidos() {
        $query = "SELECT * FROM pedidos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  


    // Método para obtener un pedido por ID
    public function obtenerPedidoPorId($id) {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Método para agregar un nuevo pedido
    public function agregarPedido($cliente, $producto, $cantidad, $fecha_pedido, $fecha_entrega, $estado) {
        // Asegúrate de que los parámetros son correctos
        $query = "INSERT INTO pedidos (id_cliente, id_producto_terminado, cantidad_pedida, fecha_pedido, fecha_entrega, estado, id_usuario)
                  VALUES (:cliente, :producto, :cantidad, :fecha_pedido, :fecha_entrega, :estado, '2')";
        $stmt = $this->db->prepare($query);
        
        // Vincula los parámetros correctamente
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':producto', $producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':fecha_pedido', $fecha_pedido);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
        $stmt->bindParam(':estado', $estado);
        
        // Ejecuta la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            // Captura el error y devuelve un mensaje más específico
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Error al agregar el pedido: " . $errorInfo[2]);
        }
    }


    // Método para editar un pedido existente
    public function editarPedido($id, $cliente, $producto, $cantidad, $fecha_pedido,$fecha_entrega, $estado) {
        $query = "UPDATE pedidos SET id_cliente = :cliente,id_producto_terminado  = :producto, cantidad_pedida = :cantidad, fecha_pedido = :fecha_pedido,fecha_entrega = :fecha_entrega , estado = :estado WHERE id_pedido = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':producto', $producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':fecha_pedido', $fecha_pedido);
        $stmt->bindParam(':fecha_entreda', $fecha_entrega);
        $stmt->bindParam(':estado', $estado);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para eliminar un pedido
    public function eliminarPedido($id) {
        $query = "DELETE FROM pedidos WHERE id_pedido = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Método para obtener clientes
    public function obtenerClientes() {
        $query = "SELECT id_cliente, nombre_cliente FROM clientes"; // Asumiendo que tienes una tabla 'clientes'
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener productos
    public function obtenerProductos() {
        $query = "SELECT id_producto_terminado, nombre_producto FROM productosterminados"; // Asumiendo que tienes una tabla 'productos'
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
