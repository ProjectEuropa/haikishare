<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
  {
     DB::table('companies')->insert([
       [
         'id' => '1',
         'name' => 'セブンイレブン',
         'store' => '今川一丁目店',
         'address' => '東住吉区今川1-13-1',
         'zip' => '5460001',
         'email' => 'seven@gmail.com',
         'password' => Hash::make('aaaaaaaa'),
         'remember_token' => str_random(10),
         'prefecture_id' => '27',
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
       ],
       [
         'id' => '2',
         'name' => 'ファミリーマート',
         'store' => '今川八丁目店',
         'address' => '東住吉区今川8-13-1',
         'zip' => '5460008',
         'email' => 'family@gmail.com',
         'password' => Hash::make('aaaaaaaa'),
         'remember_token' => str_random(10),
         'prefecture_id' => '13',
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
       ],
       [
         'id' => '3',
         'name' => 'ローソン',
         'store' => '今川五丁目店',
         'address' => '東住吉区今川5-13-1',
         'zip' => '5460005',
         'email' => 'lawson@gmail.com',
         'password' => Hash::make('aaaaaaaa'),
         'remember_token' => str_random(10),
         'prefecture_id' => '27',
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
       ]
     ]);
   }
}
