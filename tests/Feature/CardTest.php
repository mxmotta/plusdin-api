<?php

namespace Tests\Feature;

use App\Card;
use App\Category;
use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CardTest extends PassportTestCase
{

    /**
     * Create card test
     *
     * @return void
     */
    public function testCreateCard()
    {
        Storage::fake('cards');
        $file = UploadedFile::fake()->image('card.jpg');
        
        $response = $this->withHeaders($this->headers)
            ->postJson('/api/v1/cards', [
                "name"          =>  "Card test",
                "slug"          =>  "card-test",
                "image"         =>  $file,
                "limit"         =>  1499.99,
                "annual_fee"    =>  99.90,
                "brand"         =>  "visa",
                "category_id"   =>  Category::first()->id
            ]);

        $response
            ->assertCreated()
            ->assertJson([
                'success' => true,
            ]);
        
        Storage::assertExists($response->original['data']['image']);
        Storage::delete($response->original['data']['image']);
    }

    /**
     * Update card test
     *
     * @return void
     */
    public function testUpdateCard()
    {        
        Storage::fake('cards');
        $file = UploadedFile::fake()->image('card.jpg');

        $response = $this->withHeaders($this->headers)
            ->putJson('/api/v1/cards/' .  Card::first()->id, [
                "name"          =>  "Card test edited",
                "slug"          =>  "card-test edited",
                "image"         =>  $file,
                "limit"         =>  2999.99,
                "annual_fee"    =>  49.90,
                "brand"         =>  "visa",
                "category_id"   =>  Category::first()->id
            ]);

        $response
            ->assertCreated()
            ->assertJson([
                'success' => true,
            ]);
        Storage::assertExists($response->original['data']['image']);
        Storage::delete($response->original['data']['image']);
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

        $response->assertOk();
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

        $response->assertOk();
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

        $response->assertOk();
    }
}
