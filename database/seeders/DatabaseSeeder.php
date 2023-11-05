<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::factory(2)->create();
        \App\Models\Salesman::factory(20)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\SubCategory::factory(20)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\Customer::factory(100)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\SaleOn::factory(1)->create();
    }
}
