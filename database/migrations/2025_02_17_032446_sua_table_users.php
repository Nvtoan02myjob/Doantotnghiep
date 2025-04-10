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
            if (!Schema::hasColumn('users', 'auth_code')) {
                $table->unsignedBigInteger('role_id')->default(1);
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->string('auth_code', 6)->unique()->nullable();
                $table->string('phone_number')->unique()->nullable();
                $table->softDeletes(); // xóa mềm

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

        });
    }
};
