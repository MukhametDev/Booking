<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Auditorium;

class AuditoriumSeeder extends Seeder
{
    public function run()
    {
        Auditorium::create([
            'name' => 'Аудитория 101',
            'description' => 'Академические занятия ежедневно

            Технические возможности:
            Проекторы - 2шт
            Персональный компьютер
             ',
            'capacity' => 50,
            'floor' => 1,
            'phone' => '123-456-789',
        ]);

        // Добавьте больше данных, если нужно
    }
}
?>
