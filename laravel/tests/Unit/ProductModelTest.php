<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductModelTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::delete('products.json');
        // Crear un archivo JSON de prueba
        $testProducts = [
            ['id' => 1, 'title' => 'Test Product 1', 'price' => 10.99, 'created_at' => '2024-01-01 00:00:00'],
            ['id' => 2, 'title' => 'Test Product 2', 'price' => 20.99, 'created_at' => '2024-01-02 00:00:00'],
        ];
        Storage::put('products.json', json_encode($testProducts));
    }

    protected function tearDown(): void
    {
        // Eliminar el archivo JSON de prueba
        //Storage::delete('products.json');
        parent::tearDown();
    }

    public function testGetAllProducts()
    {
        $products = Product::getAllProducts();
        $this->assertCount(2, $products);
        $this->assertEquals('Test Product 1', $products[0]['title']);
    }

    public function testGetProduct()
    {
        $product = Product::getProduct(1);
        $this->assertEquals('Test Product 1', $product['title']);
    }

    public function testCreateProduct()
    {
        $allProducts_before = Product::getAllProducts();

        $newProduct = Product::createProduct(['title' => 'New Product', 'price' => 30.99]);
        $this->assertEquals('New Product', $newProduct['title']);
        $this->assertEquals(30.99, $newProduct['price']);

        $allProducts = Product::getAllProducts();
        $this->assertCount(3, $allProducts);
    }

    public function testUpdateProduct()
    {
        $allProducts = Product::getAllProducts();
        $updatedProduct = Product::updateProduct(1, ['title' => 'Updated Product', 'price' => 15.99]);
        $this->assertEquals('Updated Product', $updatedProduct['title']);
        $this->assertEquals(15.99, $updatedProduct['price']);
    }

    public function testDeleteProduct()
    {
        $allProducts_before = Product::getAllProducts();
        Product::deleteProduct(1);
        $allProducts = Product::getAllProducts();
        #dd($allProducts_before, $allProducts);
        $this->assertCount(1, $allProducts);
        $this->assertEquals('Test Product 2', $allProducts[0]['title']);
    }

    public function testSearchProducts()
    {
        $searchResults = Product::searchProducts('Test Product 1');
        $this->assertCount(1, $searchResults);
        $this->assertEquals('Test Product 1', $searchResults[0]['title']);
    }

    public function testPaginateProducts()
    {
        $paginatedProducts = Product::paginateProducts(1, 1);
        $this->assertCount(1, $paginatedProducts['data']);
        $this->assertEquals(2, $paginatedProducts['total']);
        $this->assertEquals(1, $paginatedProducts['current_page']);
        $this->assertEquals(2, $paginatedProducts['last_page']);
    }
}
