<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintainer;

class MaintainerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $m = new Maintainer();
        $m->name = "GONZALEZ";
        $m->first_name = "Alberto";
        $m->save();

        $m = new Maintainer();
        $m->name = "ALBERTO";
        $m->first_name = "Bocaboca";
        $m->save();

        $m = new Maintainer();
        $m->name = "NEYMARE";
        $m->first_name = "Jean";
        $m->save();
    }
}
