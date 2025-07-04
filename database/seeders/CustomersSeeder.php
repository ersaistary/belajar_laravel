<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customers;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers= [
            [
                'name' => 'Raya',
                'phone' => '1273648',
                'address' => 'Beijing'
            ]
        ];
        Customers::insert($customers);
    }
}
