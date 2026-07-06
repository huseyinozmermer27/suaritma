<?php
// admin/core/auth.php

// Oturum başlat
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    private $conn;
    private $table_name = "users"; // Kullanıcı tablosu adı

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT id, username, password, role FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        return true;
    }

    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header("Location: login.php"); // Giriş sayfasına yönlendir
            exit();
        }
    }
}

// Global authentication check (örnek kullanım)
// require_once __DIR__ . '/../config/db.php';
// $database = new Database();
// $db = $database->getConnection();
// $auth = new Auth($db);
// $auth->requireLogin();
?>