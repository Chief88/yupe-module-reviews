<?php if (!empty($categoryModel)) {

    $this->pageTitle = !empty($categoryModel->page_title) ? $categoryModel->page_title : $this->pageTitle;
    $this->metaDescription = !empty($categoryModel->seo_description) ? $categoryModel->seo_description : $this->metaDescription;
    $this->metaKeywords = !empty($categoryModel->seo_keywords) ? $categoryModel->seo_keywords : $this->metaKeywords;
    $this->metaNoIndex = $categoryModel->no_index == 1 ? true : false;
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

} ?>

<div class="container">
    <h1>Отзывы</h1>

    <div class="text-center">
        <a href="#" class="btn btn-primary single-line">Оставить отзыв</a>
    </div>
    <div class="sepa-50"></div>

    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'template' => "{items}\n{pager}",
            'dataProvider' => $dataProvider,
            'itemView'     => '_view',
            'itemsTagName'     => 'ul',
            'itemsCssClass'     => 'news-list reviews-list photoframes full-list',
            'htmlOptions'     => [
                'class' => 'row'
            ],
            'pagerCssClass' => 'paginator',
            'pager' => [
                'cssFile' => false,
                'firstPageLabel' => false,
                'prevPageLabel' => false,
                'nextPageLabel' => false,
                'lastPageLabel' => false,
                'internalPageCssClass' => '',
                'selectedPageCssClass' => 'active no-click',
                'header' => 'Страница:',
                'htmlOptions' => [
                    'class' => 'pages',
                ]
            ]
        ]
    ); ?>

</div>