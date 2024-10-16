<?php

namespace Database\Seeders;

use App\Models\Automovil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

        Automovil::truncate();




       Automovil::cretate(
            [
                'marca' => 'Toyota',
                'submarca' => 'Corolla',
                'modelo' => '2021',
                'Serie' => 'ABC123456789',
                'motor' => '1234567890',
                'combustible' => 'gasolina',
                'kilometraje' => '15000',
                'placas' => 'ABC123',
                'NSI' => '1234567890123456',
                'uso' => 'transporte',
                'responsable' => 'Juan Pérez',
            ],
            [
                'marca' => 'Ford',
                'submarca' => 'Focus',
                'modelo' => '2020',
                'Serie' => 'DEF987654321',
                'motor' => '0987654321',
                'combustible' => 'dicel',
                'kilometraje' => '30000',
                'placas' => 'DEF456',
                'NSI' => '6543210987654321',
                'uso' => 'comicion',
                'responsable' => 'María López',
            ],
            [
                'marca' => 'Honda',
                'submarca' => 'Civic',
                'modelo' => '2019',
                'Serie' => 'GHI123456789',
                'motor' => '1122334455',
                'combustible' => 'gasolina',
                'kilometraje' => '25000',
                'placas' => 'GHI789',
                'NSI' => '9876543210123456',
                'uso' => 'transporte',
                'responsable' => 'Carlos García',
            ],
            [
                'marca' => 'Chevrolet',
                'submarca' => 'Sonic',
                'modelo' => '2021',
                'Serie' => 'JKL123456789',
                'motor' => '2233445566',
                'combustible' => 'gasolina',
                'kilometraje' => '10000',
                'placas' => 'JKL321',
                'NSI' => '4567890123456789',
                'uso' => 'comicion',
                'responsable' => 'Ana Martínez',
            ],
            [
                'marca' => 'Nissan',
                'submarca' => 'Sentra',
                'modelo' => '2018',
                'Serie' => 'MNO123456789',
                'motor' => '3344556677',
                'combustible' => 'dicel',
                'kilometraje' => '50000',
                'placas' => 'MNO654',
                'NSI' => '6543219876543210',
                'uso' => 'ninguno',
                'responsable' => 'Luis Fernández',
            ],
            [
                'marca' => 'Mazda',
                'submarca' => '3',
                'modelo' => '2020',
                'Serie' => 'PQR123456789',
                'motor' => '4455667788',
                'combustible' => 'gasolina',
                'kilometraje' => '20000',
                'placas' => 'PQR987',
                'NSI' => '7890123456789012',
                'uso' => 'transporte',
                'responsable' => 'Sofía Torres',
            ],
            [
                'marca' => 'Hyundai',
                'submarca' => 'Elantra',
                'modelo' => '2022',
                'Serie' => 'STU123456789',
                'motor' => '5566778899',
                'combustible' => 'electrico',
                'kilometraje' => '5000',
                'placas' => 'STU321',
                'NSI' => '3210987654321098',
                'uso' => 'comicion',
                'responsable' => 'Miguel Rojas',
            ],
            [
                'marca' => 'Kia',
                'submarca' => 'Forte',
                'modelo' => '2019',
                'Serie' => 'VWX123456789',
                'motor' => '6677889900',
                'combustible' => 'gasolina',
                'kilometraje' => '18000',
                'placas' => 'VWX654',
                'NSI' => '2345678901234567',
                'uso' => 'ninguno',
                'responsable' => 'Clara Jiménez',
            ],
            [
                'marca' => 'Volkswagen',
                'submarca' => 'Jetta',
                'modelo' => '2021',
                'Serie' => 'YZA123456789',
                'motor' => '7788990011',
                'combustible' => 'dicel',
                'kilometraje' => '22000',
                'placas' => 'YZA987',
                'NSI' => '5678901234567890',
                'uso' => 'transporte',
                'responsable' => 'Fernando Ruiz',
            ],
            [
                'marca' => 'Subaru',
                'submarca' => 'Impreza',
                'modelo' => '2020',
                'Serie' => 'BCD123456789',
                'motor' => '8899001122',
                'combustible' => 'gasolina',
                'kilometraje' => '16000',
                'placas' => 'BCD543',
                'NSI' => '6789012345678901',
                'uso' => 'comicion',
                'responsable' => 'Natalia Morales',
            ],
        );
    }
}
