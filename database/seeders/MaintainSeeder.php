<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintain;

class MaintainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = new Maintain();
        $m->id_machine = 1;
        $m->id_maintainer = 1;
        $m->start_date = "2020-10-28";
        $m->end_date = "2020-10-30";
        $m->save();
    }
}
