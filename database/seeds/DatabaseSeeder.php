<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
         'admin' => '1',
         'password' => Hash::make('88090845'),
     ]);
    }
}
