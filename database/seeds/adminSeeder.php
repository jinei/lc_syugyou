<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'develop',
            'email' => 'develop@develop.com',
            'password' => Hash::make('develop'),
            'remember_token' => 0,
        ]);

    }
}
