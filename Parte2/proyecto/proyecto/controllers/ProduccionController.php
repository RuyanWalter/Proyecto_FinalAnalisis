<?php
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../models/UnidadProduccion.php';
require_once __DIR__ . '/../services/FacadeDeProduccion.php';
require_once __DIR__ . '/../services/ProcesoComposite.php';
require_once __DIR__ . '/../models/Empleados.php';  // Asegúrate de que esta línea esté presente
require_once __DIR__ . '/../models/MateriaPrima.php';   // Asegúrate de incluir esta línea
require_once __DIR__ . '/../models/Usuario.php';        // Asegúrate de incluir esta línea
// Incluir el servicio ProcesoComposite
require_once __DIR__ . '/../services/ProcesoComposite.php';

class ProduccionController {


    public function planificar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('America/Mexico_City'); // Configura tu zona horaria
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $unidad = $_POST['unidad'];
            $materiaPrima = $_POST['materia_prima'];
            $usuario = $_POST['usuario'];

            if (empty($usuario)) {
                echo "Error: Debes seleccionar un responsable para la producción.";
                exit;
            }

            $fechaInicio = date('Y-m-d'); // Usar la fecha actual

            $facade = new FacadeDeProduccion();
            $facade->iniciarProduccionCompleta($producto, $cantidad, $unidad, $materiaPrima, $fechaInicio, $usuario);

            header('Location: /produccion/generar_informe');
        } else {
            $materiasPrimas = MateriaPrima::obtenerMateriasPrimas();
            $usuarios = Usuario::obtenerUsuarios();
            $unidades = UnidadProduccion::obtenerUnidades();
            require_once '../views/produccion/planificar.php';
        }
    }
    
    // Método para asignar tarea con procesos compuestos
    public function asignarTarea() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreTarea = $_POST['nombreTarea'];
            $empleado = $_POST['empleado'];
            $unidadProduccion = $_POST['unidadProduccion'];
            $tipoTarea = $_POST['tipoTarea']; // Simple o Compuesta
    
            // Verificar si se pasó el ID de producción
            if (!isset($_POST['idProduccion'])) {
                echo "Error: ID de Producción no proporcionado.";
                exit;
            }
    
            $idProduccion = $_POST['idProduccion'];
    
            // Crear una instancia de ProcesoCompuesto si la tarea es compuesta
            if ($tipoTarea == 'compuesta') {
                $procesoProduccion = new ProcesoCompuesto($nombreTarea);
    
                // Sub-tareas, pueden ser dinámicas
                $tarea1 = new TareaSimple("Sub-tarea 1 de $nombreTarea");
                $tarea2 = new TareaSimple("Sub-tarea 2 de $nombreTarea");
    
                // Agregar las sub-tareas al proceso compuesto
                $procesoProduccion->agregar($tarea1);
                $procesoProduccion->agregar($tarea2);
    
                // Ejecutar el proceso compuesto
                $procesoProduccion->ejecutar();
            } else {
                // Si es una tarea simple
                $tarea = new TareaSimple($nombreTarea);
                $tarea->ejecutar();
            }
    
            // Guardar la tarea en la base de datos
            $facade = new FacadeDeProduccion();
            $facade->asignarTarea($idProduccion, $nombreTarea, $empleado, $unidadProduccion);
    
            header('Location: /produccion/generar_informe');
        } else {
            $idProduccion = $_GET['id'] ?? null;
            if ($idProduccion === null) {
                echo "Error: ID de Producción no proporcionado.";
                exit;
            }
    
            $produccion = Produccion::obtenerProduccionPorId($idProduccion);
            $empleados = Empleados::obtenerEmpleados();
            $unidades = UnidadProduccion::obtenerUnidades();
    
            require_once '../views/produccion/asignar_tarea.php';
        }
    }

    
    public function cambiarEstado() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idProduccion = $_POST['idProduccion'];
    
            // Verifica si todas las tareas están completas antes de cambiar el estado
            if (Produccion::todasTareasCompletas($idProduccion)) {
                Produccion::cambiarEstadoProduccion($idProduccion, 'Completada');
                Produccion::actualizarFechaFin($idProduccion); // Actualiza la fecha de finalización
            } else {
                echo "No se puede completar la producción. Hay tareas pendientes.";
            }
    
            header('Location: /produccion/generar_informe');
        }
    }
    

    // Método para generar el informe de producción (incluyendo tareas y procesos compuestos)
    public function generarInforme() {
        // Obtener los datos de producción y tareas desde los modelos
        $producciones = Produccion::obtenerProducciones();
        $tareas = Tarea::obtenerTareas();

        // Incluir la vista para mostrar el informe
        require_once '../views/produccion/generar_informe.php';
    }



    public function generarInformeDetallado() {
        if (isset($_GET['id'])) {
            $idProduccion = $_GET['id'];
            
            // Obtener la producción y las tareas asociadas
            $produccion = Produccion::obtenerProduccionPorId($idProduccion);
            
            // Verificar si se obtuvo la producción
            if (!$produccion) {
                echo "Producción no encontrada.";
                exit;
            }
    
            // Cargar la vista de informe detallado
            require_once '../views/produccion/informe_detallado.php';
        } else {
            echo "Error: ID de Producción no proporcionado.";
            exit;
        }
    }
    
}
?>
