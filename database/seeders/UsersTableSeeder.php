<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name'         => 'Nguyen Van A',
        'email'        => 'nguyenvana@gmail.com',
        'password'     => bcrypt('123456'),
        'status'       => 'pending',
        'phone_number' => '0364852853',
        'avatar'       => '',
        'address'      => 'Vinh Long, Viet Nam',
        'role_id'      => 3,
        'created_at'   => now(),
        'updated_at'   => now()
        ]);

        User::create([
        'name'         => 'Tran Thi B',
        'email'        => 'tranthib@gmail.com',
        'password'     => bcrypt('123456'),
        'status'       => 'pending',
        'phone_number' => '0364667668',
        'avatar'       => '',
        'address'      => 'Can Tho, Viet Nam',
        'role_id'      => 3,
        'created_at'   => now(),
        'updated_at'   => now()
        ]);

        User::create([
        'name'         => 'Le Van C',
        'email'        => 'levanc@gmail.com',
        'password'     => bcrypt('123456'),
        'status'       => 'pending',
        'phone_number' => '03668548387',
        'avatar'       => '',
        'address'      => 'Dong Thap, Viet Nam',
        'role_id'      => 3,
        'created_at'   => now(),
        'updated_at'   => now()
        ]);
    }
}
