<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       DB::table('categories')->insert([
         [
           'id' => '1',
           'name' => 'お弁当・丼ぶり'
         ],
         [
           'id' => '2',
           'name' => 'グラタン・ドリア'
         ],
         [
           'id' => '3',
           'name' => '麺類・パスタ'
         ],
         [
           'id' => '4',
           'name' => 'お惣菜'
         ],
         [
           'id' => '5',
           'name' => 'おにぎり'
         ],
         [
           'id' => '6',
           'name' => 'スイーツ'
         ],
         [
           'id' => '7',
           'name' => '飲料水'
         ],
         [
           'id' => '8',
           'name' => 'パン'
         ]
       ]);
     }
}
