<?php

use Illuminate\Database\Seeder;

class SensorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sensors')->insert([
            ['name' => 'Sensor de Hogar 1',   'user_id' => 4,  'type' => 'home'],
            ['name' => 'Sensor de Empresa 1', 'user_id' => 4,  'type' => 'bussiness'],
            ['name' => 'Sensor de Hogar 2',   'user_id' => 7,  'type' => 'home'],
            ['name' => 'Sensor de Hogar 3',   'user_id' => 8,  'type' => 'home'],
            ['name' => 'Sensor de Empresa 2', 'user_id' => 9,  'type' => 'bussiness'],
            ['name' => 'Sensor de Hogar 4',   'user_id' => 10, 'type' => 'home'],
            ['name' => 'Sensor de Empresa 3', 'user_id' => 11, 'type' => 'bussiness'],
        ]);
    }
}
