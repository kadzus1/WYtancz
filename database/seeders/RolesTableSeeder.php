<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{

    public function run(): void
    {
        Role::create(['name' => 'Szkoła Tańca']);
        Role::create(['name' => 'Tancerz']);

        $this->call(RolesTableSeeder::class);
    }
}
