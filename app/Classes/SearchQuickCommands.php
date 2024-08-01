<?php

namespace App\Classes;

class SearchQuickCommands
{
    public static function find($searchText) : \Illuminate\Support\Collection
    {
        $commands = collect( [
         ['keys' => ['создать клиента', 'новый клиент', 'добавить клиента'], 'text' => 'Создать клиента', 'route' => '#'],
         ['keys' => ['создать проект', 'новый проект', 'добавить проект'], 'text' => 'Создать проект', 'route' => '#'],
         ['keys' => ['создать задачу', 'новая задача', 'добавить задачу'], 'text' => 'Создать задачу', 'route' => '#'],
        ]);

        //TODO: возможно стоит вынести в отдельный хелпер для поиска по коллекциям
        $result = $commands->filter(function ($command) use ($searchText) {
            // Проверяем каждый элемент массива 'keys' на наличие искомого термина
            foreach ($command['keys'] as $key) {
                if (stripos($key, mb_strtolower($searchText)) !== false) {
                    return true; // Если найдено совпадение, возвращаем true
                }
            }
            return false; // Если ничего не найдено, возвращаем false
        });

        return $result;
    }

}
