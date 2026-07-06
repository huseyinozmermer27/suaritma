<?php
require_once 'admin/config/db.php';
$db = (new Database())->getConnection();
$stmt = $db->prepare("SELECT s_value FROM settings WHERE s_key = ?");
$stmt->execute(['marquee_items']);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($result);
?>