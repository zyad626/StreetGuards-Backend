<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $response = $this->postJson("/api/products", [
            "id" => "111",
            "title" => "Bike",
            "description" => "A bike that smells fine",
            "price" => 4201.27,
            "image" => "https://i.pinimg.com/736x/a5/7f/2d/a57f2d87d8c6500d92f702fe6ba43db0--skateboard.jpg",
            "seller" => "zoz",
            "email" => "zoz@gmail.com"
        ]);

        $response->dump();
        $response->assertStatus(200);
        $response->assertJson([
            "result" => "ok"
        ]);
    }  
    public function testGetProduct()
    {
        $response = $this->getJson("/api/products/763");
        
        $response->assertStatus(200);
        $response->assertJson([
            "data"=>[
                0=>[
                    "id"=>"763"
                ]
            ]
        ]);

    }  
    public function testDestroyProduct(){
        $response = $this->deleteJson("/api/products/222");
        $response->assertStatus(200);
        $response->assertJson([
            "result" => "ok"
        ]);
    }

    public function testUpdateProduct(){
        $response = $this->putJson("/api/products/111", [
            "id" => "111",
            "title" => "Bike",
            "description" => "A bike that smells fine",
            "price" => 4201.28,
            "image" => "https://i.pinimg.com/736x/a5/7f/2d/a57f2d87d8c6500d92f702fe6ba43db0--skateboard.jpg",
            "seller" => "zaz",
            "email" => "zoz@gmail.com"
        ]);
        $response->assertStatus(201);
        $response->assertJson([
            "result" => "ok"
        ]);
    }

    public function testGetAllProducts()
    {
        $response = $this->getJson("/api/products");
        $response->assertJsonCount(5, 'data');

    } 
    public function testGetUserProducts()
    {
        $response = $this->getJson("/api/products?options=userProducts&content=123");
        $response->assertJsonCount(1, 'data');

    } 
    public function testGetFavoriteProducts()
    {
        $response = $this->getJson("/api/products?options=userFavorits&content=123");
        $response->assertJsonCount(1, 'data');

    } 
}
