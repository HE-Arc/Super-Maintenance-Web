<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks[] = array();

        $tasks[0] = "Baque à huile";
        $tasks[1] = "Baque à copeaux";
        $tasks[2] = "Réservoire d'huile";
        $tasks[3] = "Réservoire de lubrifiant";
        $tasks[4] = "Filtre à air";
        $tasks[5] = "VSécurité des portes";
        $tasks[6] = "Chariot";
        $tasks[7] = "Palette d'outils";
        $tasks[8] = "Evacuation des copeaux";
        $tasks[9] = "Broche";
        $tasks[10] = "Broche";
        $tasks[11] = "Broche";
        $tasks[12] = "Broche";
        $tasks[13] = "Broche";
        $tasks[14] = "Broche";
        // TODO


        foreach($tasks as $aTask)
        {
            $t = new Task();
            $t->comment = $aTask;
            $t->save();
        }
    }
}
