<?php
require_once __DIR__ . '/Model.php';

class Servicio extends Model {
    protected $tabla = 'servicios';

    public function crear($nombre, $descripcion, $precio, $duracion) {
        $stmt = $this->db->prepare(
            "INSERT INTO servicios (nombre, descripcion, precio, duracion_min) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$nombre, $descripcion, $precio, $duracion]);
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $duracion) {
        $stmt = $this->db->prepare(
            "UPDATE servicios SET nombre=?, descripcion=?, precio=?, duracion_min=? WHERE id=?"
        );
        return $stmt->execute([$nombre, $descripcion, $precio, $duracion, $id]);
    }
}