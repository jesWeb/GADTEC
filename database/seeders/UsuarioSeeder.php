<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar un usuario de ejemplo con contraseña encriptada
        Usuarios::create([
            'num_empleado' => '12345',
            'nombre' => 'Juan',
            'app' => 'Pérez',
            'apm' => 'Gómez',
            'empresa' => 'DYDETEC',
            'fn' => '1985-04-25',
            'sex' => 'Masculino',
            'rol' => 'Administrador',
            'gen' => 'Masculino',
            'foto' => 'shadow.png',
            'email' => 'juan.perez@example.com',
            'usuario' => 'admin', // Nombre de usuario
            'pass' => Hash::make('admin123'), // Contraseña encriptada
            'estatus' => 'Activo',
            'activo' => 1,
        ]);

        // Insertar otro usuario con contraseñas encriptadas
        Usuarios::create([
            'num_empleado' => '67890',
            'nombre' => 'Ana',
            'app' => 'López',
            'apm' => 'Martínez',
            'empresa' => 'GÄTSIMED',
            'fn' => '1990-09-15',
            'sex' => 'Femenino',
            'rol' => 'Moderador',
            'gen' => 'Femenino',
            'foto' => 'shadow.png',
            'email' => 'ana.lopez@example.com',
            'usuario' => 'moderador', // Nombre de usuario
            'pass' => Hash::make('moderador456'), // Contraseña encriptada
            'estatus' => 'Activo',
            'activo' => 1,
        ]);


    }
}
