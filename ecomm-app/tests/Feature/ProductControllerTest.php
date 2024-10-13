<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $editor;
    protected $viewer;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $viewerRole = Role::create(['name' => 'viewer']);

        // Crear usuarios con roles
        $this->admin = User::factory()->create();
        $this->admin->roles()->attach($adminRole);

        $this->editor = User::factory()->create();
        $this->editor->roles()->attach($editorRole);

        $this->viewer = User::factory()->create();
        $this->viewer->roles()->attach($viewerRole);

        // Crear productos de prueba
        Storage::fake('local');
        $testProducts = [
            ['id' => 1, 'title' => 'Test Product 1', 'price' => 10.99, 'created_at' => '2024-01-01 00:00:00'],
            ['id' => 2, 'title' => 'Test Product 2', 'price' => 20.99, 'created_at' => '2024-01-02 00:00:00'],
        ];
        Storage::put('products.json', json_encode($testProducts));
    }

    public function testIndex()
    {
        $response = $this->actingAs($this->viewer)->get('/products');
        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    public function testCreate()
    {
        // El viewer no debería tener acceso
        $response = $this->actingAs($this->viewer)->get('/products/create');
        $response->assertStatus(403);

        // El editor debería tener acceso
        $response = $this->actingAs($this->editor)->get('/products/create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $productData = [
            'title' => 'New Test Product',
            'price' => 25.99
        ];

        // El viewer no debería poder crear productos
        $response = $this->actingAs($this->viewer)->post('/products', $productData);
        $response->assertStatus(403);

        // El editor debería poder crear productos
        $response = $this->actingAs($this->editor)->post('/products', $productData);
        $response->assertStatus(302);
        $response->assertRedirect('/products');
        
        $allProducts = Product::getAllProducts();
        $this->assertCount(3, $allProducts, 'Product was not created');
        $this->assertEquals('New Test Product', end($allProducts)['title'], 'Product title does not match');
    }

    public function testShow()
    {
        $response = $this->actingAs($this->viewer)->getJson('/products/1');
        $response->assertStatus(200);
        $response->assertJson(['title' => 'Test Product 1']);
    }

    public function testEdit()
    {
        // El viewer no debería tener acceso
        $response = $this->actingAs($this->viewer)->get('/products/1/edit');
        $response->assertStatus(403);

        // El editor debería tener acceso
        $response = $this->actingAs($this->editor)->get('/products/1/edit');
        $response->assertStatus(200);
        $response->assertViewHas('product');
    }

    public function testUpdate()
    {
        $updateData = [
            'title' => 'Updated Test Product',
            'price' => 15.99
        ];

        // El viewer no debería poder actualizar productos
        $response = $this->actingAs($this->viewer)->put('/products/1', $updateData);
        $response->assertStatus(403);

        // El editor debería poder actualizar productos
        $response = $this->actingAs($this->editor)->put('/products/1', $updateData);
        $response->assertStatus(302);
        $response->assertRedirect('/products');
        
        $updatedProduct = Product::getProduct(1);
        $this->assertEquals('Updated Test Product', $updatedProduct['title']);
    }

    public function testDestroy()
    {
        // El editor no debería poder eliminar productos
        $response = $this->actingAs($this->editor)->delete('/products/1');
        $response->assertStatus(403);

        // El admin debería poder eliminar productos
        $response = $this->actingAs($this->admin)->delete('/products/1');
        $response->assertStatus(200);
        $this->assertCount(1, Product::getAllProducts());
    }

    public function testSearch()
    {
        $response = $this->actingAs($this->viewer)->get('/products?search=Test Product 1');
        $response->assertStatus(200);
        $response->assertViewHas('products');
        $products = $response->viewData('products');
        $this->assertCount(1, $products['data']);
    }
}