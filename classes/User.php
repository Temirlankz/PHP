<?php
class User {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $aes_key = bin2hex(random_bytes(16));
        $aes_key_encrypted = openssl_encrypt($aes_key, 'AES-256-CBC', $password, 0, substr($password, 0, 16));

        $stmt = $this->conn->prepare("INSERT INTO users (username, password_hash, aes_key_encrypted) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password_hash, $aes_key_encrypted);
        return $stmt->execute();
    }
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $password_hash);
        if ($stmt->fetch() && password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }
}
