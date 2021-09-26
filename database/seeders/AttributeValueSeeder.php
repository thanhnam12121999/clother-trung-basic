<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('attribute_values')->truncate();

        DB::table('attribute_values')->insert([
            ['attribute_id' => 1, 'name' => 'S'],
            ['attribute_id' => 1, 'name' => 'M'],
            ['attribute_id' => 1, 'name' => 'L'],
            ['attribute_id' => 1, 'name' => 'XL'],
            ['attribute_id' => 2, 'name' => 'đỏ'],
            ['attribute_id' => 2, 'name' => 'đen'],
            ['attribute_id' => 2, 'name' => 'trắng'],
            ['attribute_id' => 2, 'name' => 'xanh'],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
