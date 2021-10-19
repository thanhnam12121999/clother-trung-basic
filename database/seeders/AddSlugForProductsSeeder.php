<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugForProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "RUNNING...\n";
        $products = DB::table('products')->get();
        $products->each(function ($product) {
            DB::table('products')->where('id', $product->id)->update([
                'slug' => Str::slug($product->name) . '-' . Str::random(10) . strtotime($product->created_at)
            ]);
        });
        echo "FINISH!\n";
    }
}
