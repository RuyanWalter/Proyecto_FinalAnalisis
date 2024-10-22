<?php

// Componente base que representa cualquier proceso en la producción
abstract class ProcesoProduccion {
    protected $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    // Métodos comunes a todos los procesos
    abstract public function ejecutar();
    abstract public function agregar(ProcesoProduccion $proceso);
    abstract public function eliminar(ProcesoProduccion $proceso);
    abstract public function obtenerSubProcesos();
}

// Clase para procesos individuales (tareas simples)
class TareaSimple extends ProcesoProduccion {

    public function ejecutar() {
        echo "Ejecutando tarea simple: $this->nombre\n";
    }

    public function agregar(ProcesoProduccion $proceso) {
        // Las tareas simples no pueden contener otras tareas
        throw new Exception("No se pueden agregar subprocesos a una tarea simple.");
    }

    public function eliminar(ProcesoProduccion $proceso) {
        // No se pueden eliminar subprocesos de una tarea simple
        throw new Exception("No se pueden eliminar subprocesos de una tarea simple.");
    }

    public function obtenerSubProcesos() {
        // Las tareas simples no tienen subprocesos
        return null;
    }
}

// Clase para procesos compuestos (pueden contener subprocesos o tareas)
class ProcesoCompuesto extends ProcesoProduccion {
    private $subProcesos = [];

    public function ejecutar() {
        echo "Ejecutando proceso compuesto: $this->nombre\n";
        foreach ($this->subProcesos as $proceso) {
            $proceso->ejecutar(); // Ejecutar cada subproceso
        }
    }

    public function agregar(ProcesoProduccion $proceso) {
        $this->subProcesos[] = $proceso;
    }

    public function eliminar(ProcesoProduccion $proceso) {
        foreach ($this->subProcesos as $key => $subProceso) {
            if ($subProceso === $proceso) {
                unset($this->subProcesos[$key]);
            }
        }
        // Reindexar el array después de la eliminación
        $this->subProcesos = array_values($this->subProcesos);
    }

    public function obtenerSubProcesos() {
        return $this->subProcesos;
    }
}
?>
