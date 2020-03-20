<?php

namespace Tests\Feature;

use App\Card;
use App\Category;
use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CardTest extends PassportTestCase
{

    /**
     * Create card test
     *
     * @return void
     */
    public function testCreateCard()
    {
        
        $response = $this->withHeaders($this->headers)
            ->postJson('/api/v1/cards', [
                "name"          =>  "Card test",
                "slug"          =>  "card-test",
                "image"         =>  "imagem",
                "limit"         =>  1499.99,
                "annual_fee"    =>  99.90,
                "brand"         =>  "visa",
                "category_id"   =>  Category::first()->id
            ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Update card test
     *
     * @return void
     */
    public function testUpdateCard()
    {
        $response = $this->withHeaders($this->headers)
            ->putJson('/api/v1/cards/' .  Card::first()->id, [
                "name"          =>  "Card test edited",
                "slug"          =>  "card-test edited",
                "image"         =>  "imagem",
                "limit"         =>  2999.99,
                "annual_fee"    =>  49.90,
                "brand"         =>  "visa",
                "category_id"   =>  Category::first()->id
            ]);

        $response->assertStatus(201);
    }

    /**
     * View card test
     *
     * @return void
     */
    public function testViewCard()
    {
        $response = $this->withHeaders($this->headers)
            ->get('/api/v1/cards/' . Card::first()->id);

        $response->assertStatus(200);
    }

    /**
     * List card test
     *
     * @return void
     */
    public function testListCard()
    {
        $response = $this->withHeaders($this->headers)
            ->get('/api/v1/cards/');

        $response->assertStatus(200);
    }

    /**
     * Delete card test
     *
     * @return void
     */
    public function testDeleteCard()
    {
        $response = $this->withHeaders($this->headers)
            ->delete('/api/v1/cards/' . Card::first()->id);

        $response->assertStatus(200);
    }
}
