<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'price'];

    private static $jsonPath = 'products.json';

    public static function getAllProducts()
    {
        $path = 'products.json';
        $jsonContent = Storage::get($path);
        # \Log::info('Contenido del archivo: ' . $jsonContent);
        return json_decode($jsonContent, true);
    }

    public static function getProduct($id)
    {
        $products = self::getAllProducts();
        return collect($products)->firstWhere('id', $id);
    }

    public static function createProduct($data)
    {
        $products = self::getAllProducts();
        $newId = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;
        $newProduct = [
            'id' => $newId,
            'title' => $data['title'],
            'price' => $data['price'],
            'created_at' => now()->format('Y-m-d H:i:s')
        ];
        $products[] = $newProduct;
        self::saveProducts($products);
        return $newProduct;
    }

    public static function updateProduct($id, $data)
    {
        $products = self::getAllProducts();
        $index = array_search($id, array_column($products, 'id'));
        if ($index !== false) {
            $products[$index]['title'] = $data['title'];
            $products[$index]['price'] = $data['price'];
            self::saveProducts($products);
            return $products[$index];
        }
        return null;
    }

    public static function deleteProduct($id)
    {
        $products = self::getAllProducts();
        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });
        self::saveProducts(array_values($products));
    }

    private static function saveProducts($products)
    {
        Storage::put(self::$jsonPath, json_encode($products, JSON_PRETTY_PRINT));
    }

    public static function searchProducts($term)
    {
        $products = self::getAllProducts();
        return array_filter($products, function($product) use ($term) {
            return stripos($product['title'], $term) !== false ||
                   stripos((string)$product['price'], $term) !== false ||
                   stripos($product['created_at'], $term) !== false;
        });
    }

    public static function paginateProducts($page = 1, $perPage = 10, $search = null)
    {
        $products = self::getAllProducts();

        if ($search) {
            $products = array_filter($products, function($product) use ($search) {
                return stripos($product['title'], $search) !== false ||
                    stripos((string)$product['price'], $search) !== false ||
                    stripos($product['created_at'], $search) !== false;
            });
        }

        $total = count($products);
        $pages = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;

        $paginatedItems = array_slice($products, $offset, $perPage);

        return [
            'data' => $paginatedItems,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => $pages
        ];
    }
}
