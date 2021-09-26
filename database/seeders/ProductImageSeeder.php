<?php

namespace Database\Seeders;

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

        DB::table('product_images')->insert([
            ['product_id' => 1, 'image' => Str::random(10)],
            ['product_id' => 1, 'image' => Str::random(10)],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
