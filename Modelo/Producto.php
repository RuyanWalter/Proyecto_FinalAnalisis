<?php
//Modelo/Producto.php
abstract class Producto {
    protected $nombre;
    protected $cantidad;

    public function __construct($nombre, $cantidad) {
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
    }

    abstract public function fabricar();
}
?>
