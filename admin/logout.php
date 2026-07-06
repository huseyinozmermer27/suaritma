<?php
// admin/logout.php

require_once 'config/db.php';
require_once 'core/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

$auth->logout();

header("Location: login.php");
exit();
?>