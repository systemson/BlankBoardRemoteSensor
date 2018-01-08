<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = Carbon::now();
        DB::table('users')->insert([
            [
            'user' => 'superadmin',
            'name' => 'Superadmin',
            'last_name' => null,
            'description' => 'I am the superuser. I have no limitations. Don\'t use me on production.',
            'email' => 'admin@admin.com',
            'password' => bcrypt('superadmin'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
            ['user' => 'admin',
            'name' => 'Administrator',
            'last_name' => null,
            'description' => 'I am the main administration account. Use me when you need to administrate the app.',
            'email' => 'devilu@admin.com',
            'password' => bcrypt('admin'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
            ['user' => 'manager',
            'name' => 'Manager',
            'last_name' => null,
            'description' => 'I am the manager of the app. Use me on a regular basis.',
            'email' => 'user@admin.com',
            'password' => bcrypt('manager'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
            ['user' => 'user',
            'name' => 'User',
            'last_name' => null,
            'description' => 'I am the default user. Grant me no special permissions.',
            'email' => 'user@admin.com',
            'password' => bcrypt('user'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
            ['user' => 'ventanilla',
            'name' => 'Ventanilla',
            'last_name' => null,
            'description' => '',
            'email' => 'ventanilla@admin.com',
            'password' => bcrypt('ventanilla'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
            ['user' => 'registrador',
            'name' => 'Registrador',
            'last_name' => null,
            'description' => '',
            'email' => 'ventanilla@admin.com',
            'password' => bcrypt('registrador'),
            'created_at' => $now,
            'updated_at' => $now,
            'last_password_change' => $now,
            ],
        ]);
    }
}