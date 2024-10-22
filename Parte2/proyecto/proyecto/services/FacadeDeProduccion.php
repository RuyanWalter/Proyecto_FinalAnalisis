<?php
require_once '../models/Produccion.php';
require_once '../models/Tarea.php';
require_once '../models/UnidadProduccion.php';

class FacadeDeProduccion {

    // Iniciar una nueva producción
    public function iniciarProduccionCompleta($producto, $cantidad, $unidad, $materiaPrima, $fechaFinEstimada, $usuario) {
        // Crear una nueva producción y guardarla en la base de datos
        $produccion = new Produccion($producto, $cantidad, $unidad, $materiaPrima, $fechaFinEstimada, $usuario);
        $produccion->iniciarProduccion(); // Guardar producción con todos los campos, incluyendo id_usuario
        return $produccion;
    }


    

    // Verificar el estado de una producción específica
    public function verificarEstadoProduccion($idProduccion) {
        // Obtener la producción desde el modelo
        $produccion = Produccion::obtenerProduccionPorId($idProduccion);

        // Verificar si la producción existe
        if (!$produccion) {
            return "Producción no encontrada.";
        }

        // Retornar el estado de la producción
        return $produccion['estado'];
    }

    // Generar un informe completo de todas las producciones
    public function generarInformeProduccion() {
        // Obtener todas las producciones
        $producciones = Produccion::obtenerProducciones();

        // Formatear el informe en una estructura legible
        $informe = "<h1>Informe de Producción</h1>";
        $informe .= "<table border='1'>";
        $informe .= "<thead><tr><th>Producto</th><th>Cantidad</th><th>Unidad</th><th>Fecha de Inicio</th><th>Estado</th></tr></thead>";
        $informe .= "<tbody>";

        foreach ($producciones as $produccion) {
            $informe .= "<tr>";
            $informe .= "<td>{$produccion['nombre_producto']}</td>";
            $informe .= "<td>{$produccion['cantidad_producida']}</td>";
            $informe .= "<td>{$produccion['id_unidad']}</td>";
            $informe .= "<td>{$produccion['fecha_inicio']}</td>";
            $informe .= "<td>{$produccion['estado']}</td>";
            $informe .= "</tr>";
        }

        $informe .= "</tbody>";
        $informe .= "</table>";

        // Retornar el informe generado
        return $informe;
    }

    // Método para asignar una tarea a una producción
    public function asignarTarea($idProduccion, $nombreTarea, $idEmpleado, $idUnidad) {
        // Crear una nueva tarea y asociarla a la producción
        $tarea = new Tarea($nombreTarea, $idEmpleado, $idUnidad, $idProduccion);
        $tarea->asignar();
    
        // Retornar un mensaje de éxito
        return "Tarea asignada con éxito a la producción ID: $idProduccion.";
    }
}
?>
