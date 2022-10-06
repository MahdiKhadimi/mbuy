<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Transaction::truncate();
        Product::truncate();
        Category::truncate();
        DB::table('category_product')->truncate();

        $user_quantity = 200;
        $category_quantity = 20;
        $product_quantity = 500;
        $transaction_quantity = 500;

        User::factory($user_quantity)->create();
        
        Category::factory($category_quantity)->create();
        
        Product::factory($product_quantity)->create()
        ->each(function($product){
            $categories = Category::all()->random(mt_rand(1,4))->pluck('id');
            $product->categories()->attach($categories); 
        });
       
        Transaction::factory($transaction_quantity)->create();
    
    }
}