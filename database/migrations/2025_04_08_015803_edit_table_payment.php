<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('node')->nullable()->comment('Nội dung thanh toán');
            $table->decimal('money')->nullable()->comment('Số tiền thanh toán');
            $table->string('code_vnpay')->nullable()->comment('Mã giao dịch vnpay');
            $table->integer('code_bank')->nullable()->comment('Mã giao dịch ngân hàng');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
