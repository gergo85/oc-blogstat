<?php

return [
    'plugin' => [
        'name' => 'Blog statisztika',
        'description' => 'Kiegészítő a hivatalos Blog bővítményhez.',
        'author' => 'Szabó Gergő'
    ],
    'menu' => [
        'statistics' => 'Statisztika',
        'posts' => 'Bejegyzés|Bejegyzés',
        'categories' => 'Kategória|Kategória'
    ],
    'stat' => [
        'longest' => 'Leghosszabb',
        'shortest' => 'Legrövidebb'
    ],
    'widget' => [
        'posts' => 'Blog - Bejegyzések',
        'categories' => 'Blog - Kategóriák',
        'show_total' => 'Összes mutatása',
        'show_active' => 'Aktívak mutatása',
        'show_inactive' => 'Inaktívak mutatása',
        'show_empty' => 'Üresek mutatása',
        'total' => 'Összes',
        'active' => 'Aktív',
        'inactive' => 'Inaktív',
        'empty' => 'Üres'
    ],
    'permission' => [
        'statistics' => 'Statisztika megtekintése'
    ]
];
