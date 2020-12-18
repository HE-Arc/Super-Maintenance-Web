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

        $tasks[0] = array(1, "Baque à huile");
        $tasks[1] = array(1, "Baque à copeaux");
        $tasks[2] = array(1, "Réservoire d'huile");
        $tasks[3] = array(1, "Réservoire de lubrifiant");
        $tasks[4] = array(1, "Filtre à air");
        $tasks[5] = array(1, "Sécurité des portes");
        $tasks[6] = array(1, "Chariot");
        $tasks[7] = array(1, "Palette d'outils");
        $tasks[8] = array(1, "Evacuation des copeaux");
        $tasks[9] = array(1, "Broche");
        $tasks[10] = array(1, "Lampe");
        $tasks[11] = array(1, "Ventilation");
        $tasks[12] = array(1, "Commandes manuelles");

        for ($idMachine=1; $idMachine < 5; $idMachine++) 
        { 
            foreach($tasks as $aTask)
            {
                $t = new Task();
                $t->id_machine = $idMachine;
                $t->comment = $aTask[1];
                $t->save();
            }
        }
    }
}
