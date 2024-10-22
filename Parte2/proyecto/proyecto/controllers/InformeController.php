<?php
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../services/FacadeDeProduccion.php';

class InformeController {

    public function generarInforme() {
        // Obtener los datos de producción y tareas desde los modelos
        $producciones = Produccion::obtenerProducciones();
        
        // Verificar que las tareas están incluidas en cada producción
        foreach ($producciones as &$produccion) {
            $produccion['tareas'] = Tarea::obtenerTareasPorProduccion($produccion['id_produccion']); // Asegúrate de que este método esté disponible
        }
    
        // Incluir la vista para mostrar el informe
        require_once '../views/produccion/generar_informe.php';
    }

    public function generarInformePorProduccion($idProduccion) {
        // Obtener una producción específica por su ID
        $produccion = Produccion::obtenerProduccionPorId($idProduccion);
    
        // Obtener las tareas asignadas a esa producción
        $tareas = Tarea::obtenerTareasPorProduccion($idProduccion); // Verifica que este método esté implementado
    
        // Incluir la vista para mostrar el informe específico
        require_once '../views/produccion/informe_detallado.php';
    }    
    

    // Método para generar el informe general de producción
    public function generar() {
        // Obtener todas las producciones desde el modelo Produccion
        $producciones = Produccion::obtenerProducciones();
        // Obtener todas las tareas desde el modelo Tarea
        $tareas = Tarea::obtenerTareas();

        // Incluir la vista para mostrar el informe
        require_once '../views/produccion/generar_informe.php';
    }


}
?>