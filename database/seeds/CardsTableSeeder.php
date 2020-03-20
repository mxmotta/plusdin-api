<?php

use Illuminate\Database\Seeder;
use App\Card;
use App\Category;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([
            "name"          =>  "Card Name",
            "slug"          =>  "card-name",
            "image"         =>  "imagem",
            "limit"         =>  1499.99,
            "annual_fee"    =>  99.90,
            "brand"         =>  "visa",
            "category_id"   =>  Category::first()->id
        ]);
    }
}
