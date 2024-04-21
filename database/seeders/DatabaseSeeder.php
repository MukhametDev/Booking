<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Создание обычного пользователя
         User::factory()->count(10)->create();

         // Создание администратора
         User::create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('Admin'), // Здесь установите ваш пароль
             'email_verified_at' => now(),
             'is_admin' => true,
         ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
