<?php
/**
 * Класс миграций для модуля Reviews
 *
 **/
return [
    'module'   => [
        'class' => 'application.modules.reviews.ReviewsModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/reviews' => '/reviews/reviews/index',
        '/reviews/reviews/uploadFileAjax' => '/reviews/reviews/uploadFileAjax',
    ],
];