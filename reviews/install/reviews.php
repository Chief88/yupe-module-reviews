<?php
/**
 * Класс миграций для модуля Reviews
 *
 **/
return array(
    'module'   => array(
        'class' => 'application.modules.reviews.ReviewsModule',
    ),
    'import'    => array(),
    'component' => array(),
    'rules'     => array(
        '/reviews' => '/reviews/reviews/index',
    ),
);