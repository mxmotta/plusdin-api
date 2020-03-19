<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            ['name' =>  'Silver'],
            ['name' =>  'Gold'],
            ['name' =>  'Platinum'], 
            ['name' =>  'Black']
        ];

        $bar = $this->command->getOutput()->createProgressBar(count($categories));

        foreach ($categories as $category) {

            Category::create($category);
            $bar->advance();
        }

        $bar->finish();
        echo "\n";
    }
}
