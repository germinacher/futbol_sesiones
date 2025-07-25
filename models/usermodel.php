<?php
class UserM {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function registerUser($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        return $stmt->execute();
    }
}
?>