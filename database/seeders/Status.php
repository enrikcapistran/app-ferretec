<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsStatus::create([
            'idStatus' => '1',
            'nombreStatus' => 'Activo',
        ]);

        ModelsStatus::create([
            'idStatus' => '2',
            'nombreStatus' => 'Inactivo',
        ]);

        //Status for kits
        ModelsStatus::create([
            'idStatus' => '11',
            'nombreStatus' => 'En diseño',
        ]);

        ModelsStatus::create([
            'idStatus' => '12',
            'nombreStatus' => 'Diseño Finalizado',
        ]);

        ModelsStatus::create([
            'idStatus' => '13',
            'nombreStatus' => 'Aprovado',
        ]);

        //Status for 
    }
}
