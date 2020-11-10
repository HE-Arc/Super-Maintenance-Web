<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = new Machine();
        $m->name = "AX35";
        $m->state = "ON";
        $m->location = "JU135";
        $m->save();

        $m = new Machine();
        $m->name = "AX36";
        $m->state = "OFF";
        $m->location = "JU136";
        $m->save();

        $m = new Machine();
        $m->name = "AX37";
        $m->state = "ON";
        $m->location = "JU136";
        $m->save();

        $m = new Machine();
        $m->name = "AX42";
        $m->state = "ON";
        $m->location = "JU134";
        $m->save();
    }
}
