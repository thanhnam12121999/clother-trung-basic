<?php

namespace Database\Seeders;

use App\Models\ProductVariantImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('product_images')->truncate();

        ProductVariantImage::factory()->count(150)->create(); 

        Schema::enableForeignKeyConstraints();
    }
}
