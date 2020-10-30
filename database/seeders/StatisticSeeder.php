<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Statistic();
        $s->date = '2020-06-18 12:45:56';
        $s->piece_made = 40;
        $s->save();
    }
}
