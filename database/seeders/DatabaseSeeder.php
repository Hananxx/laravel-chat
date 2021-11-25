<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(5)->create();

         User::create([
            'email' => 'admin@admin.com',
             'name' => 'admin',
             'password'=> Hash::make('123')
         ])->save();

        $this->call(ChatRoomSeeder::class);
    }
}
