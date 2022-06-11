<?php

return [
    'welcome' => [
        'header' => 'Привет от Хекслета!',
        'description' => 'Практические курсы по программированию',
        'learn_more' => 'Узнать больше'
    ],
    'filters' => [
        'submit' => 'Применить'
    ],
    'app' => [
        'name' => 'Менеджер задач',
        'logout' => 'Выход',
        'login' => 'Вход',
        'taskStatuses' => 'Статусы',
        'tasks' => 'Задачи',
        'labels' => 'Метки',
        'register' => 'Регистрация',
    ],
    'taskStatus' => [
        'index' => [
            'header' => 'Статусы',
            'edit' => 'Изменить',
            'remove' => 'Удалить',
            'remove_confirmation' => 'Вы уверены?',
            'new' => 'Создать статус',
            'actions' => 'Действия'
        ],
        'create' => [
            'header' => 'Создать статус',
            'name' => 'Имя',
            'submit' => 'Создать',
        ],
        'edit' => [
            'header' => 'Изменение статуса',
            'name' => 'Имя',
            'submit' => 'Обновить',
        ],
        'models' => [
            'id' => 'ID',
            'name' => 'Имя',
            'created_at' => 'Дата создания'
        ]
    ],
    'task' => [
        'index' => [
            'remove_confirmation' => 'Вы уверены?',
            'actions' => 'Действия',
            'header' => 'Задачи',
            'edit' => 'Изменить',
            'new' => 'Создать задачу',
            'remove' => 'Удалить',
        ],
        'show' => [
            'header' => 'Просмотр задачи: :name'
        ],
        'create' => [
            'header' => 'Создать задачу',
            'submit' => 'Создать',
        ],
        'edit' => [
            'header' => 'Изменение задачи: :name',
            'submit' => 'Обновить',
        ],
        'models' => [
            'id' => 'ID',
            'name' => 'Имя',
            'description' => 'Описание',
            'labels' => 'Метки',
            'status_id' => 'Статус',
            'createdBy' => 'Автор',
            'assignedTo' => 'Исполнитель',
            'created_at' => 'Дата создания'
        ],
    ],
    'label' => [
        'index' => [
            'remove' => 'Удалить',
            'header' => 'Метки',
            'edit' => 'Изменить',
            'new' => 'Создать метку',
            'actions' => 'Действия',
            'remove_confirmation' => 'Вы уверены?',
        ],
        'edit' => [
            'header' => 'Изменение метки',
            'submit' => 'Обновить',
        ],
        'create' => [
            'header' => 'Создать метку',
            'submit' => 'Создать',
        ],
        'models' => [
            'id' => 'ID',
            'name' => 'Имя',
            'description' => 'Описание',
            'labels' => 'Метки',
            'actions' => 'Действия',
            'created_at' => 'Дата создания'
        ],
    ],
    'forms' => [
        'default' => [
            'name' => 'Имя',
            'description' => 'Описание'
        ],
        'placeholders' => [
            'task' => [
                'status_id' => '-------------',
                'labels' => '-------------',
                'assigned_to_id' => '-------------'
            ]
        ],
        'task' => [
            'status_id' => 'Статус',
            'assigned_to_id' => 'Исполнитель',
            'labels' => 'Метки'
        ],
    ]
];
