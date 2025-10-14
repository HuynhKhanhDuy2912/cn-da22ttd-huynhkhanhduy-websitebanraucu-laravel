<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name'          => 'Admin',
        'email'         => 'admin@gmail.com',
        'password'      => bcrypt('123456'),
        'status'        => 'active',
        'phone_number'  => '0999999999',
        'avatar'        => '',
        'address'       => 'Vinh Long, Viet Nam',
        'role_id'       => 1,
        'created_at'    => now(),
        'updated_at'    => now()
        ]);


        User::create([
        'name'          => 'Staff',
        'email'         => 'staff@gmail.com',
        'password'      => bcrypt('123456'),
        'status'        => 'active',
        'phone_number'  => '0999999998',
        'avatar'        => '', 
        'address'       => 'Vinh Long, Viet Nam',
        'role_id'       => 2,
        'created_at'    => now(),
        'updated_at'    => now()
        ]);
    }
}
