<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            ['name' => 'áo', 'parent' => 0, 'slug' => 'ao-cat'],
            ['name' => 'quần', 'parent' => 0, 'slug' => 'quan-cat'],
            ['name' => 'váy', 'parent' => 0, 'slug' => 'vay-cat'],
        ]);
        
        Schema::enableForeignKeyConstraints();
    }
}
