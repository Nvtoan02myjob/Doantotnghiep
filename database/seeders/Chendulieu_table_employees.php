<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employees;

class Chendulieu_table_employees extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employees::create([
            'role_id' => 1,
            'name' => 'Nguyễn Văn A',
            'phone_number' => '0379684790',
            'address' => '32/Phùng Hưng, Thanh Khê, Đà Nẵng',
        ]);
    }
}
