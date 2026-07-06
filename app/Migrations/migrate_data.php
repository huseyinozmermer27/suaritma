<?php
require 'includes/db.php';
$db->exec('INSERT INTO product_reviews (product_id, customer_name, comment, rating, status) SELECT 2, customer_name, content, rating, status FROM reviews');
echo 'Veriler başarıyla taşındı.';
