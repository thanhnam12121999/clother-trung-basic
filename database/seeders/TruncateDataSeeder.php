<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('members')->truncate();
        DB::table('managers')->truncate();
        DB::table('accounts')->truncate();
        DB::table('customers')->truncate();
        // DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('attributes')->truncate();
        DB::table('attribute_values')->truncate();
        DB::table('attribute_product')->truncate();
        DB::table('product_images')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('orders')->truncate();
        DB::table('order_detail')->truncate();
        DB::table('notifications')->truncate();

        Schema::enableForeignKeyConstraints();
    }
}
