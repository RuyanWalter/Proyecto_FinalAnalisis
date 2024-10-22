<?php
require_once 'Producto.php';
require_once 'Camisa.php';
require_once 'Pantalon.php';
require_once 'Abrigo.php';

class ProductoFactory {
    public static function crearProducto($tipo, $nombre, $cantidad) {
        switch ($tipo) {
            case 'camisa':
                return new Camisa($nombre, $cantidad);
            case 'pantalon':
                return new Pantalon($nombre, $cantidad);
            case 'abrigo':
                return new Abrigo($nombre, $cantidad);
            default:
                throw new Exception("Tipo de producto no soportado");
        }
    }
}
?>
