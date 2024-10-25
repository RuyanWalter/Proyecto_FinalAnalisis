<?php
//Controlador/MateriaPrimaControlador1.php
require_once __DIR__ . '/../Modelo/MateriaPrima.php';
require_once __DIR__ . '/../Modelo/GestorDeInventario1.php';
require_once __DIR__ . '/../Configuracion/Database.php';

class MateriaPrimaController {
    private $gestorInventario;
    private $materiaPrima;

    public function __construct() {
        // Uso del método estático correctamente
        $db = Database::getConnection();
        $this->gestorInventario = GestorDeInventario1::obtenerInstancia();
        $this->materiaPrima = new MateriaPrima($db);
    }

    // En MateriaPrimaControlador1.php
    public function listar() {
        try {
            // Obtener los últimos ingresos de materias primas
            $materiasPrimas = $this->materiaPrima->obtenerUltimosIngresos();  // Ya apunta a la nueva tabla
            require_once 'Vista/listarMateriaPrima.php';
        } catch (Exception $e) {
            error_log("Error al listar ingresos de materias primas: " . $e->getMessage(), 0);
            echo "Error al listar ingresos de materias primas.";
        }
    }
    
       

    public function crear() {
        $proveedores = $this->obtenerProveedores();
        require_once 'Vista/registrarMateriaPrima.php';
    }

    public function guardar() {
        if ($_POST) {
            $this->materiaPrima->codigo_materia_prima = $_POST['codigo_materia_prima'];
            $this->materiaPrima->nombre = $_POST['nombre_materia_prima'];
            $this->materiaPrima->descripcion = $_POST['descripcion'] ?? '';
            $this->materiaPrima->unidad_medida = $_POST['unidad_medida'] ?? '';
            $this->materiaPrima->cantidad_comprada = $_POST['cantidad_comprada'];
            $this->materiaPrima->precio_unitario = $_POST['precio_unitario'];
            $this->materiaPrima->id_proveedor = $_POST['id_proveedor'];
            $fecha_ingreso = $_POST['fecha_ingreso'];
    
            // Guardar la compra en la base de datos
            $this->materiaPrima->registrarCompraInicial($_POST['cantidad_comprada'], $fecha_ingreso);
    
            // No agregar nuevamente la cantidad al inventario
            // La cantidad ya está registrada en el inventario al hacer el registro de compra inicial
            
            header('Location: index.php?accion=listar');
        }
    }
    
    
    
    
    // Agregar método para manejar la búsqueda de materias primas
    public function buscar() {
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';  // Capturamos el código si se envió
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';  // Capturamos la fecha si se envió
    
        // Llamamos al método del modelo con los valores capturados
        $materiasPrimas = $this->materiaPrima->buscarMateriasPrimas($codigo, $fecha);
        
        $busquedaActiva = !empty($materiasPrimas);  // Bandera para mostrar resultados
        $mensajeBusqueda = empty($materiasPrimas) ? "No hay productos registrados con ese código o fecha." : '';
        
        require_once 'Vista/listarMateriaPrima.php';
    }
    
    
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $materiaPrima = $this->materiaPrima->obtenerMateriaPrimaPorId($id);

            if ($materiaPrima) {
                $proveedores = $this->obtenerProveedores();
                require __DIR__ . '/../Vista/editarMateriaPrima.php';
            } else {
                echo "Error: Materia prima no encontrada.";
            }
        } else {
            echo "Error: No se ha proporcionado ID de materia prima.";
        }
    }

    public function actualizar() {
        if ($_POST) {
            // Depuración: imprimir todo lo que está en $_POST para verificar los valores enviados
            print_r($_POST);  // Depuración: Esto imprimirá el contenido del array $_POST
            // Puedes ver qué datos se están enviando y confirmar que `codigo_materia_prima` no está vacío
            
            // Continuar con la actualización
            $this->materiaPrima->id = $_POST['id'];
            $this->materiaPrima->codigo_materia_prima = $_POST['codigo_materia_prima'];  // Asegúrate de asignar este valor
            $this->materiaPrima->nombre = $_POST['nombre_materia_prima'];
            $this->materiaPrima->descripcion = $_POST['descripcion'];
            $this->materiaPrima->unidad_medida = $_POST['unidad_medida'];
            $this->materiaPrima->cantidad_comprada = $_POST['cantidad_comprada'];
            $this->materiaPrima->precio_unitario = $_POST['precio_unitario'];
            $this->materiaPrima->id_proveedor = $_POST['id_proveedor'];
        
            // Si todo se asigna correctamente, actualizar el registro
            if ($this->materiaPrima->actualizarMateriaPrima()) {
                header('Location: index.php?accion=listar');
            } else {
                echo "Error al actualizar la materia prima.";
            }
        } else {
            echo "No se recibió ningún dato por POST.";
        }
    }
    
    

    public function borrar() {
        // Asegurarse de que 'id' esté presente en la solicitud GET
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
    
            // Eliminar la materia prima por el ID específico
            $resultado = $this->materiaPrima->eliminarMateriaPrima($id);
    
            if ($resultado) {
                header('Location: index.php?accion=listar'); // Redirigir después de la eliminación exitosa
                exit();
            } else {
                echo "Error: No se pudo eliminar la materia prima.";
            }
        } else {
            echo "Error: ID de materia prima inválido o no proporcionado.";
        }
    }
    

    private function obtenerProveedores() {
        // Usar la conexión desde GestorDeInventario
        $db = $this->gestorInventario->getConnection();
        $query = "SELECT * FROM Proveedores";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
}

?>
