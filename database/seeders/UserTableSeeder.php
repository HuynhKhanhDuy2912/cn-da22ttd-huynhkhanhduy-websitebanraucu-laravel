<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        'address'       => 'Vĩnh Long, Việt Nam',
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
        'address'       => 'Vĩnh Long, Việt Nam',
        'role_id'       => 2,
        'created_at'    => now(),
        'updated_at'    => now()
        ]);

        User::create([
        'name'         => 'Nguyen Van A',
        'email'        => 'nguyenvana@gmail.com',
        'password'     => bcrypt('123456'),
        'status'       => 'pending',
        'phone_number' => '0364852853',
        'avatar'       => '',
        'address'      => 'Vĩnh Long, Việt Nam',
        'role_id'      => 3,
        'created_at'   => now(),
        'updated_at'   => now()
        ]);
    }
}
