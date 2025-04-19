<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ahli Gizi',
                'email' => 'gizi@example.com',
                'role_id' => 1,
                'phone_number' => '081234567890',
                'gender' => 'female',
                'birth_date' => '1990-01-01',
            ],
            [
                'name' => 'Asisten Gizi',
                'email' => 'asisten@example.com',
                'role_id' => 2,
                'phone_number' => '081234567891',
                'gender' => 'female',
                'birth_date' => '1995-05-10',
            ],
            [
                'name' => 'Joseph Smith',
                'email' => 'joseph@example.com',
                'role_id' => 3,
                'phone_number' => '081234567892',
                'gender' => 'male',
                'birth_date' => '2000-08-15',
            ],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'role_id' => $data['role_id'],
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'phone_number' => $data['phone_number'],
                    'gender' => $data['gender'],
                    'birth_date' => $data['birth_date'],
                ]
            );
        }
    }
}
