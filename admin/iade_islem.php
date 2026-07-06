<?php
require_once 'config/db.php';
require_once 'core/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);
$auth->requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $durum = $_POST['iade_durumu'];
    $not = $_POST['admin_notu'];

    $stmt = $db->prepare("UPDATE iade_talepleri SET iade_durumu = ?, admin_notu = ? WHERE id = ?");
    $stmt->execute([$durum, $not, $id]);

    header("Location: index.php?page=iade_talepleri");
    exit;
}
?>