<?php

use App\Regional;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Administrator',
                'email'             => 'admin@email.com',
                'password'          => Hash::make('password')
            ],
            [
                'name'              => 'Member',
                'email'             => 'member@email.com',
                'password'          => Hash::make('password')
            ]
        ];

        $bar = $this->command->getOutput()->createProgressBar(count($users));

        foreach ($users as $user) {
            User::create($user);
            $bar->advance();
        }

        $bar->finish();
        echo "\n";
    }
}
