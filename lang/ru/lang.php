<?php

return [
    'plugin' => [
        'name' => 'Блог Статистика и Графики',
        'description' => 'Extended plugin for RainLab Blog.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'statistics' => 'Статистика',
        'posts' => '{0} Записей|{1} Запись|[2,4] Записи|[5,Inf] Записей',
        'categories' => 'категория|категории'
    ],
    'stat' => [
        'longest' => 'Cамый длинный',
        'shortest' => 'Cамый короткий'
    ],
    'widget' => [
        'posts' => 'Блог - Посты',
        'categories' => 'Блог - Категории',
        'show_total' => 'Показать все',
        'show_active' => 'Показать активные',
        'show_inactive' => 'Показать неактивные',
        'total' => 'Всего',
        'active' => 'Активных',
        'inactive' => 'Неактивных'
    ],
    'permission' => [
        'statistics' => 'Просмотр статистики'
    ]
];
