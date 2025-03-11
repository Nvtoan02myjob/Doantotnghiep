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
        Schema::table('users', function (Blueprint $table) {
            // Không thêm lại 'phone_number' vì đã tồn tại
            if (!Schema::hasColumn('users', 'auth_code')) {
                $table->string('auth_code', 6)->unique()->nullable();
            }

            if (!Schema::hasColumn('users', 'customer_id')) {
                $table->unsignedBigInteger('customer_id')->nullable();
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'auth_code')) {
                $table->dropColumn('auth_code');
            }

            if (Schema::hasColumn('users', 'customer_id')) {
                $table->dropForeign(['customer_id']);
                $table->dropColumn('customer_id');
            }
        });
    }
};
