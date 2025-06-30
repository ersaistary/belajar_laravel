<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeOfServices;

class TypeOfServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfServices::insert([
            [
                'service_name' => 'Hanya Cuci',
                'price' => 4500,
                'description' => 'Hanya Cuci Reguler'
            ],
            [
                'service_name' => 'Hanya Gosok',
                'price' => 5000,
                'description' => 'Hanya Gosok Reguler'
            ],
            [
                'service_name' => 'Cuci Gosok',
                'price' => 5000,
                'description' => 'Cuci Gosok Reguler'
            ],
            [
                'service_name' => 'Big Laundry',
                'price' => 7000,
                'description' => 'Laundry satuan dengan ukuran besar'
            ]
        ]);
    }
}
