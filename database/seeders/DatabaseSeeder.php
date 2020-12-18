<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(MachineSeeder::class);
        $this->call(StatisticSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(MaintainerSeeder::class);
        $this->call(MaintainSeeder::class);
        $this->call(TroubleshootingReportsSeeder::class);
    }
}
