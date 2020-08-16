<?php

use Illuminate\Database\Seeder;

class RegistroTrabalhoCard extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\RegistroTrabalhoCard::class, 100)->create();
    }
}
