<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
