<?php
require_once '../config/database.php';

// En Produccion.php
class Produccion {
    private $nombreProducto;
    private $cantidadProducida;
    private $unidadProduccion;
    private $materiaPrima;
    private $fechaFinEstimada;
    private $idUsuario; // Añadir propiedad para el id_usuario

    public function __construct($nombreProducto, $cantidadProducida, $unidadProduccion, $materiaPrima, $fechaFinEstimada, $idUsuario) {
        $this->nombreProducto = $nombreProducto;
        $this->cantidadProducida = $cantidadProducida;
        $this->unidadProduccion = $unidadProduccion;
        $this->materiaPrima = $materiaPrima;
        $this->fechaFinEstimada = $fechaFinEstimada;
        $this->idUsuario = $idUsuario; // Asigna el id_usuario
    }

    public function iniciarProduccion() {
        $conn = Database::getConnection();
        $sql = "INSERT INTO Produccion (nombre_producto, cantidad_producida, id_unidad, fecha_inicio, estado, id_usuario)
                VALUES (:nombre_producto, :cantidad_producida, :id_unidad, :fecha_inicio, :estado, :id_usuario)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre_producto' => $this->nombreProducto,
            ':cantidad_producida' => $this->cantidadProducida,
            ':id_unidad' => $this->unidadProduccion,
            ':fecha_inicio' => date("Y-m-d"),
            ':estado' => 'En Proceso',
            ':id_usuario' => $this->idUsuario // Guardar el id_usuario en la base de datos
        ]);
    }

    
    

    public static function obtenerProduccionPorId($idProduccion) {
        $conn = Database::getConnection();
        
        // Consulta con JOIN para obtener el nombre de la unidad y el encargado (usuario)
        $stmt = $conn->prepare("
            SELECT p.*, u.nombre_unidad, us.nombre_usuario AS nombre_encargado
            FROM Produccion p
            JOIN UnidadesProduccion u ON p.id_unidad = u.id_unidad
            LEFT JOIN Usuarios us ON p.id_usuario = us.id_usuario
            WHERE p.id_produccion = :id_produccion
        ");
        $stmt->execute([':id_produccion' => $idProduccion]);
        $produccion = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$produccion) {
            throw new Exception("Producción no encontrada con ID: $idProduccion");
        }
    
        // Obtener tareas asociadas a la producción, incluyendo el nombre del empleado y la unidad
        $stmtTareas = $conn->prepare("
            SELECT t.*, e.nombre_empleado, u.nombre_unidad 
            FROM AsignacionTareas t
            JOIN Empleados e ON t.id_empleado = e.id_empleado
            JOIN UnidadesProduccion u ON t.id_unidad = u.id_unidad
            WHERE t.id_produccion = :id_produccion
        ");
        $stmtTareas->execute([':id_produccion' => $idProduccion]);
        $tareas = $stmtTareas->fetchAll(PDO::FETCH_ASSOC);
        $produccion['tareas'] = $tareas; // Asigna las tareas a la producción
    
        return $produccion;
    }
    
    
    
    

    public static function actualizarEstado($idProduccion, $nuevoEstado) {
        $conn = Database::getConnection();
        
        
        // Si el nuevo estado es "Completada", asignar la fecha actual como fecha de finalización
        if ($nuevoEstado === 'Completada') {
            $fechaFin = date('Y-m-d'); // Fecha actual
        } else {
            $fechaFin = null; // Si no está completada, no hay fecha de finalización
        }
    
        // Consulta para actualizar el estado de la producción y la fecha de finalización
        $sql = "UPDATE Produccion SET estado = :nuevoEstado, fecha_fin = :fechaFin WHERE id_produccion = :id_produccion";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nuevoEstado' => $nuevoEstado,
            ':fechaFin' => $fechaFin,
            ':id_produccion' => $idProduccion
        ]);
    }
    
    
        

    public static function obtenerProducciones() {
        $conn = Database::getConnection();
    
        // Consulta que incluye la fecha de finalización
        $stmt = $conn->query("
            SELECT p.*, u.nombre_unidad 
            FROM Produccion p
            JOIN UnidadesProduccion u ON p.id_unidad = u.id_unidad
            ORDER BY p.fecha_inicio ASC, p.id_produccion ASC
        ");
    
        $producciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($producciones as &$produccion) {
            // Obtener las tareas asociadas para cada producción
            $stmtTareas = $conn->prepare("SELECT * FROM AsignacionTareas WHERE id_produccion = :id_produccion");
            $stmtTareas->execute([':id_produccion' => $produccion['id_produccion']]);
            $tareas = $stmtTareas->fetchAll(PDO::FETCH_ASSOC);
            $produccion['tareas'] = $tareas;  // Asigna las tareas a la producción
        }
    
        return $producciones;
    }
    

    public static function todasTareasCompletas($idProduccion) {
        $conn = Database::getConnection();
        
        // Verifica si existe alguna tarea que no esté completada
        $stmt = $conn->prepare("
            SELECT COUNT(*) as incompletas
            FROM AsignacionTareas
            WHERE id_produccion = :id_produccion AND estado != 'Completada'
        ");
        $stmt->execute([':id_produccion' => $idProduccion]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si el conteo de tareas incompletas es mayor a 0, no se han completado todas las tareas
        return $resultado['incompletas'] == 0;
    }

    public static function cambiarEstadoProduccion($idProduccion, $nuevoEstado) {
        $conn = Database::getConnection();
        
        // Actualiza el estado de la producción
        $stmt = $conn->prepare("
            UPDATE Produccion 
            SET estado = :estado 
            WHERE id_produccion = :id_produccion
        ");
        $stmt->execute([
            ':estado' => $nuevoEstado,
            ':id_produccion' => $idProduccion
        ]);
    }


    public static function actualizarFechaFin($idProduccion) {
        $conn = Database::getConnection();
        
        // Actualiza la fecha de finalización de la producción
        $stmt = $conn->prepare("
            UPDATE Produccion 
            SET fecha_fin = :fecha_fin 
            WHERE id_produccion = :id_produccion
        ");
        $stmt->execute([
            ':fecha_fin' => date("Y-m-d"), // Establece la fecha de hoy
            ':id_produccion' => $idProduccion
        ]);
    }
    
    
    
    
    
    
}
?>
