<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TroubleshootingReport;

class TroubleshootingReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = new TroubleshootingReport();
        $t->id_machine = 2;
        $t->id_maintainer = 2;
        $t->end_date = "2020-10-28 10:30:25";
        $t->start_date ="2020-10-27 11:45:45";
        $t->troubleshooting_description = "La machine s'arrête après le premier cycle de coupe";
        $t->troubleshooting_hypotesis= "Le changement d'outils pour le deuxième cycle est bloquer | L'évacuation des déchets ne marche plus";
        $t->troubleshooting_check = "Le changement d'outils fonctionne bien, par contre le vérin de la trape d'évacuation est défectueux";
        $t->repairs_actions = "Remplacement du vérin d'évacuation";
        $t->piece_to_change = "Vérin pneumatique Festo 200XC35-b";
        $t->resolved = true;

        $t->piece_photo = "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";
        $t->save();
    }
}
