<?php
class DeleteT {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    // Obtener equipos por usuario
    public function getTeamsByUser($user_id) {
        $teams = [];
        $stmt = $this->db->prepare("SELECT team FROM register WHERE user_id = ? GROUP BY team");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row["team"];
        }
        return $teams;
    }

    // Verifica si el equipo existe
    public function teamExists($team, $user_id) {
        $stmt = $this->db->prepare("SELECT team FROM register WHERE team = ? AND user_id = ?");
        $stmt->bind_param("si", $team, $user_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Elimina el equipo
    public function deleteTeam($team, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM register WHERE team = ? AND user_id = ?");
        $stmt->bind_param("si", $team, $user_id);
        return $stmt->execute();
    }
}
?>