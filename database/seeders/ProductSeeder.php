<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tạo 1 mảng chứa tất cả id của categories
        $categoryID = DB::table('categories')->pluck('id')->toArray();

        $proSeed = [];
        for($i=0;$i<10;$i++){
            $proSeed[]=[
                'name'=>fake()->name(),
                'price'=>fake()->randomNumber(),
                'quantity'=>fake()->randomNumber(),
                'image'=>fake()->imageUrl(),
                'category_id'=>fake()->randomElement($categoryID),
                'description'=>fake()->text(),
                'status'=>fake()->numberBetween(0,1),
            ];
        }
        DB::table('products')->insert($proSeed);
    }
}
