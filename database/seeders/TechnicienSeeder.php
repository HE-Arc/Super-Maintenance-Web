<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technicien;

class TechnicienSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $m = new Technicien();
        $m->name = "GONZALEZ";
        $m->first_name = "Alberto";
        $m->save();

        $m = new Technicien();
        $m->name = "ALBERTO";
        $m->first_name = "Bocaboca";
        $m->save();

        $m = new Technicien();
        $m->name = "NEYMARE";
        $m->first_name = "Jean";
        $m->save();
    }
}
