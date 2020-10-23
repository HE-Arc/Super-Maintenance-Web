<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintainer;

class InitMaintainerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $m = new Maintainer();
        $m->lastname = "GONZALEZ";
        $m->firstname = "Alberto";
        $m->save();
    }
}
