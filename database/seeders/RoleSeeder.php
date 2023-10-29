<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Thesis Adviser']);
        Role::create(['name' => 'Technical Editor']);
        Role::create(['name' => 'System Expert']);
        Role::create(['name' => 'Student']);
    }
}
