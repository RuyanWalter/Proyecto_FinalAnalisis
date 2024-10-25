<?php
// Controlador/ProduccionController.php

// Corregimos las rutas usando __DIR__ y navegando hacia la carpeta correcta.
require_once __DIR__ . '/../Modelo/Produccion.php';
require_once __DIR__ . '/../Modelo/Tarea.php';
require_once __DIR__ . '/../Modelo/UnidadProduccion.php';
require_once __DIR__ . '/../services/FacadeDeProduccion.php';
require_once __DIR__ . '/../services/ProcesoComposite.php';
require_once __DIR__ . '/../Modelo/Empleados.php';  
require_once __DIR__ . '/../Modelo/IngresoMateriaPrima.php';
require_once __DIR__ . '/../Modelo/EgresoMateriaPrima.php';
require_once __DIR__ . '/../Modelo/Usuario.php';

class ProduccionController {

    public function planificar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $unidad = $_POST['unidad'];
            $codigoMateriaPrima = $_POST['codigo_materia_prima'];  // Campo actualizado para el código de materia prima
            $cantidadMateriaPrima = $_POST['cantidad_materia_prima'];  
            $usuario = $_POST['usuario'];

            if (empty($usuario)) {
                echo "Error: Debes seleccionar un responsable para la producción.";
                exit;
            }

            // Iniciar la producción y obtener el ID de la producción recién creada
            $facade = new FacadeDeProduccion();
            $produccionId = $facade->iniciarProduccionCompleta($producto, $cantidad, $unidad, $codigoMateriaPrima, date('Y-m-d', strtotime('+5 days')), $usuario);

            try {
                // Restar cantidad de materia prima del inventario
                IngresoMateriaPrima::restarCantidadComprada($codigoMateriaPrima, $cantidadMateriaPrima);

                // Registrar el egreso de materia prima en la tabla `egresomateriaprima`
                EgresoMateriaPrima::registrarEgreso($codigoMateriaPrima, $cantidadMateriaPrima, $produccionId);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }

            // Redirigir al informe de producción
            header('Location: /produccion/generar_informe');
        } else {
            // Obtener las materias primas, usuarios y unidades de producción para mostrarlas en el formulario
            $materiasPrimas = IngresoMateriaPrima::obtenerMateriasPrimas();
            $usuarios = Usuario::obtenerUsuarios();
            $unidades = UnidadProduccion::obtenerUnidades();
            require_once 'Vista/produccion/planificar.php';
        }
    }

    public function asignarTarea() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreTarea = $_POST['nombreTarea'];
            $empleado = $_POST['empleado'];
            $unidadProduccion = $_POST['unidadProduccion'];
            $tipoTarea = $_POST['tipoTarea']; // Simple o Compuesta
    
            if (!isset($_POST['idProduccion'])) {
                echo "Error: ID de Producción no proporcionado.";
                exit;
            }
    
            $idProduccion = $_POST['idProduccion'];
    
            if ($tipoTarea == 'compuesta') {
                $procesoProduccion = new ProcesoCompuesto($nombreTarea);
    
                $tarea1 = new TareaSimple("Sub-tarea 1 de $nombreTarea");
                $tarea2 = new TareaSimple("Sub-tarea 2 de $nombreTarea");
    
                $procesoProduccion->agregar($tarea1);
                $procesoProduccion->agregar($tarea2);
    
                $procesoProduccion->ejecutar();
            } else {
                $tarea = new TareaSimple($nombreTarea);
                $tarea->ejecutar();
            }
    
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
    
            require_once 'Vista/produccion/asignar_tarea.php';
        }
    }

    public function cambiarEstado() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idProduccion = $_POST['idProduccion'];
    
            if (Produccion::todasTareasCompletas($idProduccion)) {
                Produccion::cambiarEstadoProduccion($idProduccion, 'Completada');
                Produccion::actualizarFechaFin($idProduccion);
            } else {
                echo "No se puede completar la producción. Hay tareas pendientes.";
            }
    
            header('Location: /produccion/generar_informe');
        }
    }

    public function generarInforme() {
        $producciones = Produccion::obtenerProducciones();
        $tareas = Tarea::obtenerTareas();

        require_once 'Vista/produccion/generar_informe.php';
    }

    public function generarInformeDetallado() {
        if (isset($_GET['id'])) {
            $idProduccion = $_GET['id'];
            
            $produccion = Produccion::obtenerProduccionPorId($idProduccion);
            
            if (!$produccion) {
                echo "Producción no encontrada.";
                exit;
            }
    
            require_once 'Vista/produccion/informe_detallado.php';
        } else {
            echo "Error: ID de Producción no proporcionado.";
            exit;
        }
    }
}
?>
