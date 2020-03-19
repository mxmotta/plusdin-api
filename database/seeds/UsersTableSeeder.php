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
                'password'          => Hash::make('password'),
                'role'              => 'admin'
            ],
            [
                'name'              => 'Member',
                'email'             => 'member@email.com',
                'password'          => Hash::make('password'),
                'role'              => 'user'
            ]
        ];

        $bar = $this->command->getOutput()->createProgressBar(count($users));

        foreach ($users as $user) {
            $role = config('roles.models.role')::where('slug', $user['role'])->first();
            unset($user['role']);

            $user = User::create($user);
            $user->attachRole($role);

            $bar->advance();
        }

        $bar->finish();
        echo "\n";
    }
}
