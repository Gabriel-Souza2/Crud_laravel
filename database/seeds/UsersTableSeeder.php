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
    {   $this->createUserAdmin();
        factory(\App\User::class, 5)->create();
    }

    private function createUserAdmin()
    {
        \App\User::create([
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'is_admin' => 1
        ]);
    }
}
