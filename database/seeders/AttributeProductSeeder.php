<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AttributeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('attribute_product')->truncate();

        DB::table('attribute_product')->insert([
            ['product_id' => 1, 'attribute_value_id' => 1],
            ['product_id' => 1, 'attribute_value_id' => 2],
            ['product_id' => 1, 'attribute_value_id' => 3],
            ['product_id' => 1, 'attribute_value_id' => 6],
            ['product_id' => 1, 'attribute_value_id' => 7],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
