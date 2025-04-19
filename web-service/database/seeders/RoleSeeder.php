<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['ahli gizi', 'asisten ahli gizi', 'pelanggan'];

        foreach ($roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if (! $role) {
                Role::create(['name' => $roleName]);
            }
        }
    }
}
