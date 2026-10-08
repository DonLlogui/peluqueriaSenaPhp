<?php
require_once __DIR__ . '/../config/database.php';

class Model {
    protected $db;
    protected $tabla;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function todos() {
        $stmt = $this->db->query("SELECT * FROM {$this->tabla}");
        return $stmt->fetchAll();
    }

    public function buscar($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabla} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->tabla} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}