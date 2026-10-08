<?php
require_once __DIR__ . '/Model.php';

class Cita extends Model {
    protected $tabla = 'citas';

    public function crear($usuario_id, $barbero_id, $servicio_id, $fecha, $hora, $observaciones = '') {
        $stmt = $this->db->prepare(
            "INSERT INTO citas (usuario_id, barbero_id, servicio_id, fecha, hora, observaciones) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$usuario_id, $barbero_id, $servicio_id, $fecha, $hora, $observaciones]);
    }

    public function obtenerConDetalles() {
        $stmt = $this->db->query(
            "SELECT c.*, 
                    s.nombre AS servicio_nombre, 
                    s.precio AS servicio_precio,
                    b.nombre AS barbero_nombre,
                    u.nombre AS usuario_nombre
             FROM citas c
             INNER JOIN servicios s ON c.servicio_id = s.id
             INNER JOIN barberos b ON c.barbero_id = b.id
             INNER JOIN usuarios u ON c.usuario_id = u.id
             ORDER BY c.fecha DESC, c.hora DESC"
        );
        return $stmt->fetchAll();
    }

    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->db->prepare(
            "SELECT c.*, 
                    s.nombre AS servicio_nombre, 
                    s.precio AS servicio_precio,
                    b.nombre AS barbero_nombre
             FROM citas c
             INNER JOIN servicios s ON c.servicio_id = s.id
             INNER JOIN barberos b ON c.barbero_id = b.id
             WHERE c.usuario_id = ?
             ORDER BY c.fecha DESC, c.hora DESC"
        );
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    public function actualizarEstado($id, $estado) {
        $stmt = $this->db->prepare(
            "UPDATE citas SET estado = ? WHERE id = ?"
        );
        return $stmt->execute([$estado, $id]);
    }

    public function hayCitaDisponible($barbero_id, $fecha, $hora) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM citas 
             WHERE barbero_id = ? AND fecha = ? AND hora = ? AND estado != 'cancelada'"
        );
        $stmt->execute([$barbero_id, $fecha, $hora]);
        return $stmt->fetchColumn() == 0;
    }
}