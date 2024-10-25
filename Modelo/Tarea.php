<?php
//Modelo/Tarea.php
require_once 'configuracion/Database.php';

class Tarea {
    private $nombreTarea;
    private $idEmpleado;
    private $idUnidadProduccion;
    private $idProduccion; // Se agrega este parámetro faltante

    public function __construct($nombreTarea, $idEmpleado, $idUnidadProduccion, $idProduccion) {
        $this->nombreTarea = $nombreTarea;
        $this->idEmpleado = $idEmpleado;
        $this->idUnidadProduccion = $idUnidadProduccion;
        $this->idProduccion = $idProduccion; // Guardar el ID de la producción
    }

    // Método para asignar una tarea
    public function asignar() {
        $conn = Database::getConnection();
        $sql = "INSERT INTO AsignacionTareas (nombre_tarea, id_empleado, id_unidad, id_produccion, fecha_asignacion)
                VALUES (:nombre_tarea, :id_empleado, :id_unidad, :id_produccion, :fecha_asignacion)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre_tarea' => $this->nombreTarea,
            ':id_empleado' => $this->idEmpleado,
            ':id_unidad' => $this->idUnidadProduccion,
            ':id_produccion' => $this->idProduccion, // Asegúrate de pasar este valor
            ':fecha_asignacion' => date("Y-m-d")
        ]);
    }

    // Método para obtener todas las tareas
    public static function obtenerTareas() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM AsignacionTareas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarTarea($idTarea) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM AsignacionTareas WHERE id_tarea = :id_tarea");
        $stmt->execute([':id_tarea' => $idTarea]);
    }

public static function completarTarea($idTarea) {
    $conn = Database::getConnection();
    $sql = "UPDATE AsignacionTareas SET estado = 'Completada' WHERE id_tarea = :id_tarea"; // Cambia el estado
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id_tarea' => $idTarea]);
}

    
    
    
}
?>
