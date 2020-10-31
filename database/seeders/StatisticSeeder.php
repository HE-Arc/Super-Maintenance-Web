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
        $stats = array(
            '2020-10-30 22:00:00' => 200,
            '2020-10-30 20:00:00' => 190,
            '2020-10-30 18:00:00' => 190,
            '2020-10-30 16:00:00' => 190,
            '2020-10-30 14:00:00' => 200,
            '2020-10-30 12:00:00' => 200,
            '2020-10-30 10:00:00' => 200,
            '2020-10-30 08:00:00' => 150,
            '2020-10-30 06:00:00' => 150,
            '2020-10-30 04:00:00' => 160,
            '2020-10-30 02:00:00' => 160,
            '2020-10-30 00:00:00' => 170,
            '2020-10-29 22:00:00' => 170,
            '2020-10-29 20:00:00' => 190,
            '2020-10-29 18:00:00' => 190,
            '2020-10-29 16:00:00' => 210,
            '2020-10-29 14:00:00' => 200,
            '2020-10-29 12:00:00' => 200,
            '2020-10-29 10:00:00' => 0,
            '2020-10-29 08:00:00' => 0,
            '2020-10-29 06:00:00' => 0,
            '2020-10-29 04:00:00' => 100,
            '2020-10-29 02:00:00' => 200,
            '2020-10-29 00:00:00' => 200,
            '2020-10-28 22:00:00' => 160,
            '2020-10-28 20:00:00' => 180,
            '2020-10-28 18:00:00' => 200,
            '2020-10-28 16:00:00' => 220,
            '2020-10-28 14:00:00' => 200,
            '2020-10-28 12:00:00' => 200,
            '2020-10-28 10:00:00' => 0,
            '2020-10-28 08:00:00' => 0,
            '2020-10-28 06:00:00' => 0,
            '2020-10-28 04:00:00' => 100,
            '2020-10-28 02:00:00' => 200,
            '2020-10-28 00:00:00' => 200,
            '2020-10-27 22:00:00' => 120,
            '2020-10-27 20:00:00' => 150,
            '2020-10-27 18:00:00' => 150,
            '2020-10-27 16:00:00' => 190,
            '2020-10-27 14:00:00' => 200,
            '2020-10-27 12:00:00' => 200,
            '2020-10-27 10:00:00' => 20,
            '2020-10-27 08:00:00' => 40,
            '2020-10-27 06:00:00' => 70,
            '2020-10-27 04:00:00' => 100,
            '2020-10-27 02:00:00' => 200,
            '2020-10-27 00:00:00' => 200,
        );

        foreach($stats as $date => $value)
        {
            $s = new Statistic();
            $s->date = $date;
            $s->piece_made = $value;
            $s->save();
        }
    }
}