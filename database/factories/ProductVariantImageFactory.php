<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariantImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariantImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::all()->random()->id, 
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
