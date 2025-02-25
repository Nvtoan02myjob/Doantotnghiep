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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('type_news_id');
            $table->text('title');
            $table->text('summary');
            $table->text('content');
            $table->text('image');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('type_news_id')->references('id')->on('type_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
