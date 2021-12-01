<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // Admin
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@test.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$Tz8KW1vWlv6yyyBSFNnZLup0H3om2N24BvAR29sGSeQT5XmX8MbFK', // 123456789
            'remember_token'    => Str::random(10),
            'is_admin'          => 1,
        ]);

        // User

        User::create([
            'name'              => 'User test',
            'email'             => 'user@test.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$Tz8KW1vWlv6yyyBSFNnZLup0H3om2N24BvAR29sGSeQT5XmX8MbFK', // 123456789
            'remember_token'    => Str::random(10),
        ]);
    }
}
