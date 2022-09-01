<?php

namespace Database\Seeders;

use App\Models\Seller\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::query()->create([
            'name' => 'Ademir',
            'email' => 'teste@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
