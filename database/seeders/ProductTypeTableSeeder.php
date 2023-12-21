<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeTableSeeder extends Seeder
{
    public function run(): void
    {
        ProductType::factory()->create(['name' => 'Одежда']);
        ProductType::factory()->create(['name' => 'Аксессуары']);
        ProductType::factory()->create(['name' => 'Пины']);
        ProductType::factory()->create(['name' => 'Значки']);
        ProductType::factory()->create(['name' => 'Кружки']);
        ProductType::factory()->create(['name' => 'Стикеры']);
        ProductType::factory()->create(['name' => 'Нашивки']);
    }
}
