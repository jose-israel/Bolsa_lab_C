<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero, ejecuta el seeder de roles
        $this->call(RoleSeeder::class);

        // Crear un usuario administrador por defecto
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'), // Asegúrate de usar un hash seguro
        ]);

        // Asignar el rol 'admin' al usuario
        $user->assignRole($adminRole);
    }
}
