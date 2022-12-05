<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                "categoria" => "Aventura",
            ],
            [
                "categoria" => "Accion",
            ],
            [
                "categoria" => "Terro",
            ],
            [
                "categoria" => "Romance",
            ],
            [
                "categoria" => "Fantasia",
            ],
            [
                "categoria" => "Historia",
            ],
        ]);
    }
}
