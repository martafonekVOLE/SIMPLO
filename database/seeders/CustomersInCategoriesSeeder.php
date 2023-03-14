<?php

namespace Database\Seeders;

use App\Models\CustomersInCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersInCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomersInCategories::factory()->count(5)->create();
    }
}
