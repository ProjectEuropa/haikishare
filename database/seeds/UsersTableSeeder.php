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
        [
          'id' => '1',
          'name' => 'taro',
          'email' => 'taro@gmail.com',
          'password' => Hash::make('aaaaaaaa'),
        ],
        [
          'id' => '2',
          'name' => 'yamada',
          'email' => 'yamada@gmail.com',
          'password' => Hash::make('aaaaaaaa'),
        ],
        [
          'id' => '3',
          'name' => 'tanaka',
          'email' => 'tanaka@gmail.com',
          'password' => Hash::make('aaaaaaaa'),
        ],
      ]);
    }
}
