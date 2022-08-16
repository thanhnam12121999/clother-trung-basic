<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'code' => Str::random(10),
            'feature_image' => $this->faker->imageUrl($width = 640, $height = 480),
            'summary' => $this->faker->realText($maxNbChars = 100, $indexSize = 2),
            'detail' => $this->faker->text(),
            'description' => $this->faker->text(),
            'status' => Arr::random(['0', '1']),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
