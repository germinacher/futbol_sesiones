<?php
class InsertT {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    // Verifica si un equipo ya existe para el usuario
    public function teamExists($team, $user_id) {
        $stmt = $this->db->prepare("SELECT team FROM register WHERE team = ? AND user_id = ?");
        $stmt->bind_param("si", $team, $user_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Inserta un nuevo equipo
    public function insertTeam($team, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO register (team, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $team, $user_id);
        return $stmt->execute();
    }
}
?>