<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'clave' => 'ADMIN',
                'nombre' => 'Administrador',
                'descripcion' => 'Gestiona el sistema completo de control vehicular, incluyendo usuarios, vehículos y permisos.',
                'estatus' => 'Activo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clave' => 'MOD',
                'nombre' => 'Moderador',
                'descripcion' => 'Supervisa las actividades de los usuarios y revisa el estado de los vehículos.',
                'estatus' => 'Activo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clave' => 'VIG',
                'nombre' => 'Vigilante',
                'descripcion' => 'Monitorea el acceso vehicular y reporta irregularidades en los permisos de circulación.',
                'estatus' => 'Activo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
