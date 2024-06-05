<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // you can use: save(), create(), createMany()
        //insert()

        $categories = [
            [
                'name' => 'Theatre',
                'updated_at' => Now(),
                'created_at' => Now()
            ],
            [
                'name' => 'Carnival',
                'updated_at' => Now(),
                'created_at' => Now()

            ],
            [
                'name' => 'Outdoors',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        $this->category->insert($categories);
    }
}
