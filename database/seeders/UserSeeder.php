<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        // Crear usuario admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole);

        // Crear usuario editor
        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
        ]);
        $editor->roles()->attach($editorRole);

        // Crear usuario viewer
        $viewer = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => Hash::make('password'),
        ]);
        $viewer->roles()->attach($viewerRole);
    }
}