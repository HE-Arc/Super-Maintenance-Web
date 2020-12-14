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
        $m->start_date = "2020-10-28 11:45:45";
        $m->end_date = "2020-10-28 15:32:41";
        $m->planned_at= "2020-10-28";
        $m->save();

        $m = new Maintain();
        $m->id_machine = 1;
        $m->id_maintainer = 1;
        $m->start_date = null;
        $m->end_date = null;
        $m->planned_at= "2020-11-28";
        $m->save();

        $m = new Maintain();
        $m->id_machine = 2;
        $m->id_maintainer = 4;
        $m->start_date = "2020-09-13 18:25:12";
        $m->end_date = "2020-09-14 09:22:03";
        $m->planned_at= "2020-09-13";
        $m->save();

        $m = new Maintain();
        $m->id_machine = 2;
        $m->id_maintainer = 4;
        $m->start_date = "2020-09-08 11:10:17";
        $m->end_date = "2020-09-09 19:42:39";
        $m->planned_at= "2020-09-08";
        $m->save();
    }
}
