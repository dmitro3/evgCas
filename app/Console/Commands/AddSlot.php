<?php

namespace App\Console\Commands;

use App\Models\Slot;
use Illuminate\Console\Command;

class AddSlot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-slot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавить новый слот в базу данных';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Добавление нового слота');

        $name = $this->ask('Введите название слота');
        $idGame = $this->ask('Введите id игры');
        $description = $this->ask('Введите описание слота (необязательно)', null);
        $image = $this->ask('Введите путь к изображению слота');
        $route = $this->ask('Введите маршрут слота');
        $isActive = $this->confirm('Слот активен?', true);

        try {
            $slot = Slot::create([
                'name' => $name,
                'id_game' => $idGame,
                'description' => $description,
                'image' => $image,
                'route' => $route,
                'is_active' => $isActive,
            ]);

            $this->info("Слот '{$slot->name}' успешно добавлен с ID: {$slot->id}");
        } catch (\Exception $e) {
            $this->error('Ошибка при добавлении слота: ' . $e->getMessage());
        }
    }
}
