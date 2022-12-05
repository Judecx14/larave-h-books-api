<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name" => "admin",
                "email" =>"admin@gmail.com",
                "password" =>"admin",
                "rol" => "admin"
            ],
            [
                "name" => "juan",
                "email" => "juan@gmail.com",
                "password" => "juan",
                "rol" => "user"
            ],
        ]);
    }
}
