<?php
// Configuracion/Database.php

class Database {
    // Atributo estático que contendrá la única instancia de la conexión (Singleton)
    private static $conn = null;

    // Constructor privado para evitar la creación de múltiples instancias
    private function __construct() {}

    // Método estático para obtener la conexión de la base de datos
    public static function getConnection() {
        // Si aún no existe la conexión, se crea una nueva
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=apffu", "root", "");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->exec("set names utf8mb4"); // Asegurar el uso de UTF-8 para la base de datos
            } catch (PDOException $exception) {
                error_log("Error en la conexión: " . $exception->getMessage(), 0);
                die("Error de conexión, intenta más tarde.");
            }
        }
        // Retorna la instancia de la conexión
        return self::$conn;
    }

    // Método para evitar que se pueda clonar el objeto
    private function __clone() {}

    // Método para evitar que se pueda unserializar el objeto
    public function __wakeup() {} // Cambiado a public
}
?>

