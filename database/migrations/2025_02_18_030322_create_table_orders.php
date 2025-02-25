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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            $table->integer('status')->default(0);
            $table->string('pin_code', 5);
            $table->decimal('price_total',10,2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
