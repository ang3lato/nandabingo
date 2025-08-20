<?php
class dbConex {
    public $db;
    
    public function conex() {
        try {
            require_once __DIR__ . '/config.php';
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $this->db;
        } catch (PDOException $e) {
            error_log("ERROR DE CONEXION: " . $e->getMessage());
            return false;
        }
    }
}
?>