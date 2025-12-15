<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;


class MarcaSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            ['nombre' => 'KTM'],
            ['nombre' => 'Husqvarna'],
            ['nombre' => 'GasGas'],
            ['nombre' => 'Sherco'],
            ['nombre' => 'Beta'],
            ['nombre' => 'Rieju'],
            ['nombre' => 'TM Racing'],
            ['nombre' => 'Fantic'],
            ['nombre' => 'Yamaha'],
            ['nombre' => 'Honda'],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
