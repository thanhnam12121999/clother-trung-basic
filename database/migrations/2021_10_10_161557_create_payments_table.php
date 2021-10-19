<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->decimal('money')->nullable()->comment('Số tiền thanh toán');
            $table->string('note')->nullable()->comment('Nội dung thanh toán');
            $table->string('vnp_response_code')->nullable()->comment('Mã phản hồi');
            $table->string('code_vnpay')->nullable()->comment('Mã giao dịch vnpay');
            $table->string('code_bank')->nullable()->comment('Mã ngân hàng');
            $table->dateTime('payment_time')->comment('Thời gian giao dịch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
