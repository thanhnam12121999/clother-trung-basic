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
            ['attribute_id' => 2, 'name' => 'Đỏ'],
            ['attribute_id' => 2, 'name' => 'Đen'],
            ['attribute_id' => 2, 'name' => 'Trắng'],
            ['attribute_id' => 2, 'name' => 'Xanh'],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
