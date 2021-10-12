<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySomeColumnProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->renameColumn('variant', 'variant_value');
        });
        if (Schema::hasColumn('product_variants', 'variant_value')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->string('variant_text')->nullable()->after('variant_value');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->renameColumn('variant_value', 'variant');
            $table->dropColumn('variant_text');
        });
    }
}
