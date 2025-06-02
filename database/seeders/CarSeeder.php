<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
    'name' => 'Toyota Camry',
    'price' => 1250000000,
    'description' => 'Mẫu sedan cao cấp, tiết kiệm nhiên liệu',
    'image' => 'cars/toyota-camry.jpg',
]);
    }
}
