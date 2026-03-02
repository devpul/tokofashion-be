<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'          =>  'ibnu',
                'email'         =>  'ibnubachdar@gmail.com',
                'password'      =>  'bachdar123',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
            [
                'name'          =>  'ridho',
                'email'         =>  'ridho@gmail.com',
                'password'      =>  'ridho123',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ]
        ]);
    }
}
