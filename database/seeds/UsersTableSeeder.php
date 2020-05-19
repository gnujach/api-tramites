<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'anonymous',
            'email' => 'anonymous@example.com',
            'password' => Hash::make('1234')
        ]);
    }
}
