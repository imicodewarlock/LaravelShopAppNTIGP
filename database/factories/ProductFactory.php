<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;

        // Set the path where images will be saved
        $imagePath = public_path('storage/images/products');

        // Ensure the directory exists
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true);
        }

        return [
            'name' => $faker->words(2, true),
            'description' => $faker->paragraph(5),
            'photo' => $faker->image($imagePath, 640, 480, null, false),
            'price' => $faker->randomFloat(2, 10, 1000),
            'category_id' => ProductCategory::factory(),
        ];
    }
}
