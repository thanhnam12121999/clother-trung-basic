<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->nullable()->default(1);
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->bigInteger('accountable_id');
            $table->string('accountable_type');
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
