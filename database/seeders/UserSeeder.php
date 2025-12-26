<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Gibran Wicaksono',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rafi1702'),
        ]);

        $role = Role::find(1);
        $user->assignRole($role);
    }
}