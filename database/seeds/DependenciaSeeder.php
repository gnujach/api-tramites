<?php

use Illuminate\Database\Seeder;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dependencias')->insert([
            'nombre' => 'Secretaría de Educación de Guanajuato',
            'alias' => 'SEG',
        ]);
    }
}
