<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),
            'description'=>$this->faker->paragraph(1),
            'image'=>$this->faker->randomElement(['1.PNG', '2.PNG', '3.jpg']),
            'quantity'=>$this->faker->numberBetween(1,10),
            'currency'=> $currency=$this->faker->randomElement(['AFG','USD']),
            'price'=> $currency==='AFG'?$this->faker->numberBetween(100,1000):$this->faker->numberBetween(10,100),
            'status'=>$this->faker->randomElement([Product::AVAILABLE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
            'seller_id'=>User::all()->random()->id
        ];
    }
}