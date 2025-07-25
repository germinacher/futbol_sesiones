<?php
class DeleteA {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    // Borra todos los datos del usuario: partidos y tabla de posiciones
    public function resetLeagueForUser($user_id) {
        $stmt = $this->db->prepare("DELETE FROM register WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->db->prepare("DELETE FROM matches WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>