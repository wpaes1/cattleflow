<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
     use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Farm::factory()->create([
            'farm_name' => 'FAZENDA DOIS DE MAIO',
            'registration_number' => 'I.R 123456789',
            'owner_name' => 'ARISTIDES SILVEIRA LOPES',
            'location' => 'PANTANAL DE PORTO MURTINHO, SN',
            'city' => 'PORTO MURTINHO',
            'state_registration' => 'MATO GROSSO DO SUL',
            'country' => 'BRASIL',
            'total_area' => '1700.00',

        ],
        [
            'farm_name' => 'FAZENDA M2 CONFINAMENTO',
            'registration_number' => 'I.R 987654321',
            'owner_name' => 'FABIO MARQQUES RIBEIRO',
            'location' => 'FAZ. VALE VERDE D ASNOR, SN',
            'city' => 'JARAGUARI',
            'state_registration' => 'MATO GROSSO DO SUL',
            'country' => 'BRASIL',
            'total_area' => '40.00',
        ]);
    }
}
