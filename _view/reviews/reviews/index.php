<?php
$this->pageTitle = 'Отзывы';
$this->breadcrumbs = ['Отзывы'];
?>

<div class="content">
    <div class="patern-container">
        <h1>Отзывы наших клиентов</h1>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider'  => $dataProvider,
            'itemView'      => '_view',
            'template'      => "{pager}\n{items}\n{pager}",
            'itemsCssClass' => 'seo-reviews',
            'itemsTagName'  => 'ul',
            'pager' => [
                'cssFile' => false,
                'prevPageLabel' => '',
                'firstPageLabel' => '',
                'nextPageLabel' => '',
                'lastPageLabel' => '',
                'previousPageCssClass' => 'page-list-nav page-prev',
                'firstPageCssClass' => 'page-list-nav page-first',
                'nextPageCssClass' => 'page-list-nav page-next',
                'lastPageCssClass' => 'page-list-nav page-last',
                'selectedPageCssClass' => 'selected no-click',
                'header' => '',
                'htmlOptions' => [
                    'class' => 'page-list',
                ],

            ],
        ]
    ); ?>

</div>