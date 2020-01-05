<?php

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
      DB::table('users')->insert([
         'name' => 'Higor',
         'email' => 'hcnlinux@gmail.com',
         'password' => Hash::make('12345'),
     ]);
    }
}
