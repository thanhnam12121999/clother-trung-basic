<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('attributes')->truncate();

        DB::table('attributes')->insert([
            ['name' => 'size'],
            ['name' => 'màu sắc'],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
