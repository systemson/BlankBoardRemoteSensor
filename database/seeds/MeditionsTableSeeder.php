<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MeditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = 24;

        $users = \App\Models\User::select('id')->where('dni', '<>', null)->get();
        foreach($users as $user) {

          $sensors = \App\Models\Sensor::select('id')->where('user_id', $user->id)->get();
            foreach($sensors as $sensor) {

                for($x=0; $x < 365; $x++) {
                    $insert[] = [
                        'medition' => rand(10, 100),
                        'user_id' => $user->id,
                        'sensor_id' => $sensor->id,
                        'paid' => false,
                        'created_at' => Carbon::now()->subDays($x),
                        'updated_at' => Carbon::now()->subDays($x),
                    ];
                }
            }
        }

        DB::table('meditions')->insert($insert);
    }
}
