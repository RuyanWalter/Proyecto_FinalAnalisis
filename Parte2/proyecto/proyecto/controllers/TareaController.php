<?php
require_once '../models/Tarea.php';

class TareaController {
    public function asignar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarea = new Tarea($_POST['nombreTarea'], $_POST['empleado'], $_POST['unidadProduccion']);
            $tarea->asignar();
            header('Location: /produccion/generar_informe');
        }
    }

    public function mostrarTareas() {
        $tareas = Tarea::obtenerTareas();
        require_once '../views/produccion/tareas.php'; // Cambia según la vista que desees mostrar
    }


    public function completar() {
        if (isset($_POST['idTarea'])) {
            $idTarea = $_POST['idTarea'];

            // Actualizar el estado de la tarea en la base de datos
            Tarea::completarTarea($idTarea); // Este método debe cambiar el estado de la tarea a 'Completada'

            // Redirigir a la vista de informe después de completar la tarea
            header('Location: /produccion/generar_informe');
            exit;
        }
    }

    
    public function eliminar() {
        if (isset($_POST['idTarea'])) {
            $idTarea = $_POST['idTarea'];
            Tarea::eliminarTarea($idTarea); // Elimina la tarea de la base de datos
            header('Location: /produccion/generar_informe');
            exit;
        }
    }
    
    
}

?>
