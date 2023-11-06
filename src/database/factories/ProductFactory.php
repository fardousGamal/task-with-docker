<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'logo' => $this->faker->imageUrl,
            'description' => $this->faker->title,
            'price' => $this->faker->randomFloat('2',0,2),
            'quantity' => random_int(1, 6),
            'expiration_date' => now()->addMonth(2),
            'note' => null,
            'category_id' => Category::first()->id ?? 1,
            'vendor_id' =>random_int(1, 4)
        ];
    }
}
