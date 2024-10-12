<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductControllerTest extends TestCase
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
        // Storage::delete('products.json');
        parent::tearDown();
    }

    public function testIndex()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    public function testCreate()
    {
        $response = $this->get('/products/create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->withoutMiddleware()
                        ->post('/products', [
            'title' => 'New Test Product',
            'price' => 25.99
        ]);
        
        $this->assertEquals(302, $response->getStatusCode(), 'Unexpected status code');
        
        $response->assertRedirect('/products');
        
        $allProducts = Product::getAllProducts();
        $this->assertCount(3, $allProducts, 'Product was not created');
        $this->assertEquals('New Test Product', end($allProducts)['title'], 'Product title does not match');
    }

    public function testShow()
    {
        $response = $this->getJson('/products/1');
        $response->assertStatus(200);
        $response->assertJson(['title' => 'Test Product 1']);
    }

    public function testEdit()
    {
        $response = $this->get('/products/1/edit');
        $response->assertStatus(200);
        $response->assertViewHas('product');
    }

    public function testUpdate()
    {
        $response = $this->withoutMiddleware()->put('/products/1', [
            'title' => 'Updated Test Product',
            'price' => 15.99
        ]);
        
        $response->assertRedirect('/products');
        $updatedProduct = Product::getProduct(1);
        $this->assertEquals('Updated Test Product', $updatedProduct['title']);
    }

    public function testDestroy()
    {
        $response = $this->withoutMiddleware()->delete('/products/1');
        $response->assertStatus(200);
        $this->assertCount(1, Product::getAllProducts());
    }

    public function testSearch()
    {
        $response = $this->get('/products?search=Test Product 1');
        $response->assertStatus(200);
        $response->assertViewHas('products');
        $products = $response->viewData('products');
        $this->assertCount(1, $products['data']);
    }
}
