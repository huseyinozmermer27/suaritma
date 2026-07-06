<?php
require_once '../includes/db.php';

$username = 'admin';
$password = 'admin123';
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("DELETE FROM users WHERE username = ?");
$stmt->execute([$username]);

$stmt = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
$stmt->execute([$username, 'admin@admin.com', $hashed]);

echo "Admin kullanıcı adı: " . $username . "<br>";
echo "Admin şifresi: " . $password . "<br>";
echo "Hash: " . $hashed . "<br>";
echo "<a href='login.php'>Giriş yapmayı dene</a>";
?>
