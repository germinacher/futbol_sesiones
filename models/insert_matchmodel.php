<?php
class InsertM {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    // Obtener equipos del usuario
    public function getUserTeams($user_id) {
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

    // Registrar partido
    public function registerMatch($home, $away, $home_score, $away_score, $user_id) {
        // Verificar si ya se jugó
        $stmt = $this->db->prepare("SELECT 1 FROM matches WHERE home_team = ? AND away_team = ? AND user_id = ?");
        $stmt->bind_param("ssi", $home, $away, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return "Ese partido ya fue jugado.";
        }

        $now = date("Y-m-d H:i:s");

        if ($home_score > $away_score) {
            $this->db->query("INSERT INTO register (team, played, win, points, gf, gc, user_id)
                              VALUES ('$home', 1, 1, 3, $home_score, $away_score, $user_id)");
            $this->db->query("INSERT INTO register (team, played, defeat, gf, gc, user_id)
                              VALUES ('$away', 1, 1, $away_score, $home_score, $user_id)");
            $home_result = 'W'; $away_result = 'L';
        } elseif ($home_score < $away_score) {
            $this->db->query("INSERT INTO register (team, played, win, points, gf, gc, user_id)
                              VALUES ('$away', 1, 1, 3, $away_score, $home_score, $user_id)");
            $this->db->query("INSERT INTO register (team, played, defeat, gf, gc, user_id)
                              VALUES ('$home', 1, 1, $home_score, $away_score, $user_id)");
            $home_result = 'L'; $away_result = 'W';
        } else {
            $this->db->query("INSERT INTO register (team, played, draw, points, gf, gc, user_id)
                              VALUES ('$home', 1, 1, 1, $home_score, $away_score, $user_id)");
            $this->db->query("INSERT INTO register (team, played, draw, points, gf, gc, user_id)
                              VALUES ('$away', 1, 1, 1, $away_score, $home_score, $user_id)");
            $home_result = $away_result = 'D';
        }

        // Insertar en tabla de partidos
        $stmt = $this->db->prepare("INSERT INTO matches (home_team, away_team, home_score, away_score, home_result, away_result, date, user_id) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiissi", $home, $away, $home_score, $away_score, $home_result, $away_result, $now, $user_id);
        $stmt->execute();

        return "Partido registrado correctamente.";
    }
}
?>