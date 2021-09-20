<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MofifyProductVariantImagesTableToProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variant_images', function(Blueprint $table) {
            $table->dropForeign(['product_variant_id']);
            $table->dropIndex('product_variant_images_product_variant_id_foreign');
        });
        Schema::rename('product_variant_images', 'product_images');
        Schema::table('product_images', function (Blueprint $table) {
            $table->renameColumn('product_variant_id', 'product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropIndex('product_images_product_id_foreign');
        });
        Schema::rename('product_images', 'product_variant_images');
        Schema::table('product_variant_images', function(Blueprint $table) {
            $table->renameColumn('product_id', 'product_variant_id');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }
}
