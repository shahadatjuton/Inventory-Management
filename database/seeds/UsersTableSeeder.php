<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'role_id'=>'1',
            'email'=>'admin@gmail.com',
            'phone'=>'017********',
            'address'=>'123/A, Mohammadpur,Dhaka-1207',
            'password'=>bcrypt('admin1234'),
        ]);
        DB::table('users')->insert([

            'name'=>'User',
            'role_id'=>'2',
            'email'=>'user@gmail.com',
            'phone'=>'017********',
            'address'=>'123/A, Mohammadpur,Dhaka-1207',
            'password'=>bcrypt('user1234'),
        ]);
        DB::table('users')->insert([
            'name'=>'Customer',
            'role_id'=>'1',
            'email'=>'customer@gmail.com',
            'phone'=>'017********',
            'address'=>'123/A, Mohammadpur,Dhaka-1207',
            'password'=>bcrypt('customer1234'),
        ]);
        DB::table('users')->insert([

            'name'=>'Supplier',
            'role_id'=>'1',
            'email'=>'supplier@gmail.com',
            'phone'=>'017********',
            'address'=>'123/A, Mohammadpur,Dhaka-1207',
            'password'=>bcrypt('supplier1234'),
        ]);
    }
}

