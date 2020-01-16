<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        factory(User::class, 9)->create();
    }
}
