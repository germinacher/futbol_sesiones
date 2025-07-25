<?php
class MatchesM {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    // Obtener todos los partidos del usuario ordenados por fecha descendente
    public function getMatchesByUser($user_id) {
        $stmt = $this->db->prepare("
            SELECT home_team, home_score, away_team, away_score, date 
            FROM matches 
            WHERE user_id = ?
            ORDER BY date DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>