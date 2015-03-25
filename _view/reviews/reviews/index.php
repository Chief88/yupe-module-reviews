<?php
$this->pageTitle = 'Отзывы';
$this->breadcrumbs = array('Отзывы');
?>

<div class="content">
    <div class="patern-container">
        <h1>Отзывы наших клиентов</h1>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        array(
            'dataProvider'  => $dataProvider,
            'itemView'      => '_view',
            'template'      => "{pager}\n{items}\n{pager}",
            'itemsCssClass' => 'seo-reviews',
            'itemsTagName'  => 'ul',
            'pager' => array(
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
                'htmlOptions' => array(
                    'class' => 'page-list',
                ),

            ),
        )
    ); ?>

</div>