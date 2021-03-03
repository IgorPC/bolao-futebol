<?php

namespace Database\Seeders;

use App\Models\StatusJogo;
use Illuminate\Database\Seeder;

class StatusJogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusJogo::create([
            'id' => 1,
            'value' => 'aberto'
        ]);

        StatusJogo::create([
            'id' => 2,
            'value' => 'encerrado'
        ]);

        StatusJogo::create([
            'id' => 3,
            'value' => 'cancelado'
        ]);

        StatusJogo::create([
            'id' => 4,
            'value' => 'aguardando'
        ]);
    }
}
