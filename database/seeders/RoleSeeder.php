<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    const roles = [
        'super-admin',
        'admin',
        'moderator',
        'specialist',
        'customer',
        'director',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
