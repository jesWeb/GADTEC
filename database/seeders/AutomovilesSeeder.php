<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutomovilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('automoviles')->insert([
            [
                'marca' => 'Toyota',
                'submarca' => 'Corolla',
                'modelo' => 2023,
                'num_serie' => '123ABC456XYZ',
                'num_motor' => 'ENG4567890',
                'capacidad_combustible' => 50,
                'tipo_combustible' => 'Gasolina',
                'tipo_automovil' => 'Automovil',
                'kilometraje' => 0.00,
                'placas' => 'ABC1234',
                'num_nsi' => 'NSI001234567',
                'uso' => 'Personal',
                'estatus' => 'Nuevo',
                'estatusIn' => 'Disponible',
                'color' => 'Rojo',
                'num_puertas' => 4,
                'fecha_registro' => '2024-01-01',
                'responsable' => 'Juan Pérez',
                'fotografias' => 'imagen1.jpg',
                'observaciones' => 'Vehículo nuevo en perfecto estado.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Honda',
                'submarca' => 'Civic',
                'modelo' => 2022,
                'num_serie' => '789XYZ123ABC',
                'num_motor' => 'ENG1234567',
                'capacidad_combustible' => 45,
                'tipo_combustible' => 'Diésel',
                'tipo_automovil' => 'Automovil',
                'kilometraje' => 15000.50,
                'placas' => 'XYZ5678',
                'num_nsi' => 'NSI009876543',
                'uso' => 'Empresarial',
                'estatus' => 'Usado',
                'estatusIn' => 'Disponible',
                'color' => 'Azul',
                'num_puertas' => 4,
                'fecha_registro' => '2023-06-15',
                'responsable' => 'Ana López',
                'fotografias' => 'imagen2.jpg',
                'observaciones' => 'Revisión técnica reciente realizada.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Tesla',
                'submarca' => 'Model S',
                'modelo' => 2024,
                'num_serie' => 'TES456789ABC',
                'num_motor' => 'ENGTESLA123',
                'capacidad_combustible' => 0, // Vehículo eléctrico
                'tipo_combustible' => 'Eléctrico',
                'tipo_automovil' => 'Automovil',
                'kilometraje' => 100.00,
                'placas' => 'TESLA123',
                'num_nsi' => 'NSI002345678',
                'uso' => 'Personal',
                'estatus' => 'Nuevo',
                'estatusIn' => 'Disponible',
                'color' => 'Negro',
                'num_puertas' => 4,
                'fecha_registro' => '2024-02-10',
                'responsable' => 'Luis Martínez',
                'fotografias' => 'imagen3.jpg',
                'observaciones' => 'Vehículo eléctrico de última generación.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
