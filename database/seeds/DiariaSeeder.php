<?php

use Illuminate\Database\Seeder;

class DiariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Diaria::class, 10)->create();
    }
}
