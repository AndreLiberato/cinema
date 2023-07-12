<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'André Liberato';
        $user->email = 'andre.liberato@outlook.com.br';
        $user->password = Hash::make('senha123');
        $user->save();
    }
}
