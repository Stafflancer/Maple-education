<?php

return [
    'title' => 'FAQ',
    'author' => 'Devseonet',
    'version' => '1.0.0',
    'sort_order' => 3,
    'menu' => [
        'label' => 'FAQ',
        'icon' => 'question-circle',
        'items' => [
            ['label' => 'Категории', 'icon' => 'sitemap', 'url' => ['/admin/faq/faq-category']],
            ['label' => 'Вопросы', 'icon' => 'question', 'url' => ['/admin/faq/faq']],
        ],
    ],
];
