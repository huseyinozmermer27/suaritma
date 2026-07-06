<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Fetch product by slug with its variants
     * 
     * @param string $slug
     * @return array|bool
     */
    public function getBySlug(string $slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $product = $stmt->fetch();

        if ($product) {
            $product['variants'] = $this->getVariants($product['id']);
        }

        return $product;
    }

    /**
     * Fetch variants for a specific product
     * 
     * @param int $productId
     * @return array
     */
    public function getVariants(int $productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM product_variants WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll();
    }

    /**
     * Fetch all products (optional helper)
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
