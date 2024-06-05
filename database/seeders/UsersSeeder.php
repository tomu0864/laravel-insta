<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gamil.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'updated_at' => Now(),
                'created_at' => Now()
            ],
            [
                'name' => 'User',
                'email' => 'user@gamil.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'updated_at' => Now(),
                'created_at' => Now()
            ],
            [
                'name' => 'User2',
                'email' => 'user2@gamil.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'updated_at' => Now(),
                'created_at' => Now()
            ],
        ];

        $this->user->insert($users);
    }
}
