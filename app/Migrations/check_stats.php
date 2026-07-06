<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$stats = $db->query("
    SELECT AVG(rating) as avg_rating, COUNT(*) as total_count 
    FROM (
        SELECT rating FROM reviews WHERE status = 1 
        UNION ALL 
        SELECT rating FROM product_reviews WHERE status = 1
    ) as all_reviews
")->fetch(PDO::FETCH_ASSOC);
print_r($stats);
?>