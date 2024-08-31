<?php

namespace App\Classes;

class SearchQuickCommands
{
    public static function find($searchText) : \Illuminate\Support\Collection
    {
        $commands = collect( [
         ['keys' => ['создать клиента', 'новый клиент', 'добавить клиента'],
             'text' => 'Создать клиента',
             'route' => 'clients.create',
             'symbol' => '+'],
         ['keys' => ['создать проект', 'новый проект', 'добавить проект'],
             'text' => 'Создать проект',
             'route' => 'projects.create',
             'symbol' => '+'
         ],
         ['keys' => ['создать задачу', 'новая задача', 'добавить задачу'],
             'text' => 'Создать задачу',
             'route' => 'clients',
             'symbol' => '+'
         ],
            ['keys' => ['главная', 'домой', 'домашняя'],
                'text' => 'Главная страница',
                'route' => 'dashboard',
                'symbol' => '/'],
            ['keys' => ['клиенты', 'просмотр клиентов', 'все клиенты'],
                'text' => 'Все клиенты',
                'route' => 'clients',
                'symbol' => '/'],
            ['keys' => ['настройки', 'параметры', 'настроить'],
                'text' => 'Настройки',
                'route' => 'clients',
                'symbol' => '>'],
        ],
        );

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
