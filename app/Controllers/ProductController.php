<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    /**
     * Display product detail page
     * 
     * @param string $slug
     */
    public function show($slug)
    {
        $productModel = new Product();
        $product = $productModel->getBySlug($slug);

        if (!$product) {
            $this->notFound();
            return;
        }

        // Pass data to view
        require_once '../views/frontend/product-detail.php';
    }

    /**
     * Handle 404 Not Found
     */
    private function notFound()
    {
        http_response_code(404);
        echo "<h1>404 Ürün Bulunamadı</h1>";
        echo "<p>Aradığınız ürün sitemizde bulunmamaktadır.</p>";
    }
}
