<?php
//Configuracion/Database.php
class Database {
    private $host = "localhost";
    private $db_name = "gestion_textil";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8mb4");
        } catch (PDOException $exception) {
            error_log("Error en la conexión: " . $exception->getMessage(), 0);
            die("Error de conexión, intenta más tarde.");
        }
        return $this->conn;
    }
}
?>
