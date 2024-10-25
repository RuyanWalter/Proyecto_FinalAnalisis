<?php
// Modelo/MateriaPrima.php
class MateriaPrima {
    private $conn;
    private $table_name = "IngresoMateriaPrima";  // Nombre de la tabla corregido

    public $id;
    public $codigo_materia_prima;
    public $nombre;
    public $descripcion;
    public $unidad_medida;
    public $cantidad_comprada;  // Cambiado stock_actual a cantidad_comprada
    public $precio_unitario;
    public $id_proveedor;
    public $fecha_ingreso;  // Añadido campo fecha_ingreso 

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener los últimos cinco ingresos de materia prima
    public function obtenerUltimosIngresos() {
        $query = "SELECT im.*, COALESCE(p.nombre_proveedor, 'Sin Proveedor') AS nombre_proveedor 
                  FROM IngresoMateriaPrima im
                  LEFT JOIN Proveedores p ON im.id_proveedor = p.id_proveedor
                  ORDER BY im.id_ingreso DESC 
                  LIMIT 5";  // Asegurado el uso de la tabla correcta
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar compra inicial en la tabla IngresoMateriaPrima
    public function registrarCompraInicial($cantidad_ingresada, $fecha_ingreso) {
        $query = "INSERT INTO IngresoMateriaPrima (codigo_materia_prima, nombre_materia_prima, descripcion, unidad_medida, 
                    cantidad_comprada, precio_unitario, fecha_ingreso, id_proveedor)
                  VALUES (:codigo_materia_prima, :nombre_materia_prima, :descripcion, :unidad_medida, 
                          :cantidad_comprada, :precio_unitario, :fecha_ingreso, :id_proveedor)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_materia_prima', $this->codigo_materia_prima);
        $stmt->bindParam(':nombre_materia_prima', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':unidad_medida', $this->unidad_medida);
        $stmt->bindParam(':cantidad_comprada', $cantidad_ingresada);  // Uso de cantidad_comprada en lugar de stock_actual
        $stmt->bindParam(':precio_unitario', $this->precio_unitario);
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->bindParam(':id_proveedor', $this->id_proveedor);
        $stmt->execute();
    }

// Función para buscar materias primas mejorada
public function buscarMateriasPrimas($codigo = '', $fecha = '') {
    $sql = "SELECT im.*, COALESCE(p.nombre_proveedor, 'Sin Proveedor') AS nombre_proveedor 
            FROM IngresoMateriaPrima im 
            LEFT JOIN Proveedores p ON im.id_proveedor = p.id_proveedor
            WHERE 1=1";  // Usamos 1=1 para facilitar la construcción dinámica de la consulta

    // Si se ingresa un código, agregamos la condición
    if (!empty($codigo)) {
        $sql .= " AND LOWER(im.codigo_materia_prima) LIKE :codigo";
    }

    // Si se ingresa una fecha, agregamos la condición
    if (!empty($fecha)) {
        $sql .= " AND im.fecha_ingreso = :fecha";
    }

    $stmt = $this->conn->prepare($sql);

    // Solo enlazamos los parámetros si se proporcionan
    if (!empty($codigo)) {
        $codigo = '%' . strtolower(trim($codigo)) . '%';  // Para que sea una búsqueda flexible
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    }

    if (!empty($fecha)) {
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    }

    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    // Obtener una materia prima por ID
    public function obtenerMateriaPrimaPorId($id) {
        $query = "SELECT * FROM IngresoMateriaPrima WHERE id_ingreso = :id";  // Uso de id_ingreso
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar materia prima
    public function actualizarMateriaPrima() {
        $query = "UPDATE IngresoMateriaPrima SET 
                    codigo_materia_prima = :codigo_materia_prima,
                    nombre_materia_prima = :nombre, 
                    descripcion = :descripcion, 
                    unidad_medida = :unidad_medida, 
                    cantidad_comprada = :cantidad_comprada,  
                    precio_unitario = :precio_unitario, 
                    id_proveedor = :id_proveedor
                  WHERE id_ingreso = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codigo_materia_prima", $this->codigo_materia_prima);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":unidad_medida", $this->unidad_medida);
        $stmt->bindParam(":cantidad_comprada", $this->cantidad_comprada);
        $stmt->bindParam(":precio_unitario", $this->precio_unitario);
        $stmt->bindParam(":id_proveedor", $this->id_proveedor);
        $stmt->bindParam(":id", $this->id);  
    
        return $stmt->execute();
    }
    
    
    // Eliminar materia prima por ID
    public function eliminarMateriaPrima($id) {
        $query = "DELETE FROM IngresoMateriaPrima WHERE id_ingreso = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

}

?>
