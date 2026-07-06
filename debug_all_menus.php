<?php
require_once 'config/config.php';
require_once 'app/Core/Database.php';

try {
    $db = \App\Core\Database::getInstance()->getConnection();
    $res = $db->query('SELECT name, link FROM menus');
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo $e->getMessage();
}
