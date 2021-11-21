<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'demecs.florian@blathy.info',
            'password' => Hash::make(Str::random(10)),
            'login_type' => 'oauth_azure',
            'role' => 'admin',
        ]);

        User::create([
            'email' => 'harangozo.zsolt@blathy.info',
            'password' => Hash::make(Str::random(10)),
            'login_type' => 'oauth_azure',
            'role' => 'admin',
        ]);


    }
}
