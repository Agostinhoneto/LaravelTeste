<?php

use App\Report;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::create([
            'title' => 'Relatório 1',
            'description' => 'Descrição do Relatório 1',
        ]);

        Report::create([
            'title' => 'Relatório 2',
            'description' => 'Descrição do Relatório 2',
        ]);
    }
}
