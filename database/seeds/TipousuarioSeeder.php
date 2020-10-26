<?php

use Illuminate\Database\Seeder;

class TipousuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipousuarios')->insert([
            'nombre' => 'Interno',
        ]);
        DB::table('tipousuarios')->insert([
            'nombre' => 'Externo',
        ]);
    }
}
