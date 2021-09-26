<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('product_variants')->truncate();

        DB::table('product_variants')->insert([
            ['product_id' => 1, 'variant' => '[1, 4]', 'amount' => 1, 'unit_price' => 150000],
            ['product_id' => 1, 'variant' => '[1, 5]', 'amount' => 1, 'unit_price' => 150000],
            ['product_id' => 1, 'variant' => '[2, 4]', 'amount' => 1, 'unit_price' => 200000],
            ['product_id' => 1, 'variant' => '[2, 5]', 'amount' => 1, 'unit_price' => 100000],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
