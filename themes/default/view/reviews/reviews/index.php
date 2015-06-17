<?php if (!empty($categoryModel)) {
    $this->pageTitle = !empty($categoryModel->page_title) ? $categoryModel->page_title : $this->pageTitle;
    $this->metaDescription = !empty($categoryModel->seo_description) ? $categoryModel->seo_description : $this->metaDescription;
    $this->metaKeywords = !empty($categoryModel->seo_keywords) ? $categoryModel->seo_keywords : $this->metaKeywords;
    $this->metaNoIndex = $categoryModel->no_index == 1 ? true : false;
}

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
$model = \Yii::app()->session['aReviews']['form'];
$module = \Yii::app()->session['aReviews']['module'];
?>

<div class="container">
    <h1>Отзывы</h1>

    <div class="text-center">
        <a href="#"
           class="btn btn-primary single-line"
           data-toggle="modal"
           data-target="#reviews-modal">Оставить отзыв</a>
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

<div class="modal fade" id="reviews-modal">
    <div class="modal-dialog">

        <?php $form = $this->beginWidget(
            '\yupe\widgets\ActiveForm',
            [
                'id'                        => 'reviews-form',
                'type'                      => 'vertical',
                'enableAjaxValidation'      => false,
                'enableClientValidation'    => true,
                'clientOptions'             =>[
                    'validateOnSubmit' => true,
                ],
                'htmlOptions'               => [
                    'enctype' => 'multipart/form-data'
                ],

            ]
        ); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Оставить отзыв</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-7">
                            <?php echo $form->textFieldGroup($model, 'name', [
//                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'placeholder' => 'Ваше имя'
                                    ]
                                ],
                            ]); ?>

                            <?php echo $form->textFieldGroup($model, 'email', [
//                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'type' => 'email',
                                        'placeholder' => 'E-mail'
                                    ]
                                ],
                            ]); ?>

                            <?php echo $form->textAreaGroup($model, 'message', [
//                                'label' => false,
//                                'errorOptions' => false,
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'placeholder' => 'Ваше мнение',
                                        'style' => 'min-height: 120px',
                                    ]
                                ],
                            ]); ?>
                        </div>

                        <div class="col-xs-5">
                            <?php echo CHtml::image(
                                $mainAssets . '/images/nophoto.jpg',
                                $model->name,
                                [
                                    'class' => 'preview-image border',
                                    'style' => 'margin-top: 24px; max-width: 100%;'
                                ]
                            ); ?>


                            <?php echo $form->fileFieldGroup($model, 'image', [
//                                    'label' => false,
                                    'widgetOptions' => [
                                        'htmlOptions' => [
                                            'onchange' => 'readURL(this);',
                                            'style'    => 'background-color: inherit;'
                                        ]
                                    ]
                                ]
                            ); ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php echo CHtml::submitButton('Отправить',[
                            'class'=>'btn btn-primary'
                        ]
                    ); ?>

                </div>
            </div><!-- /.modal-content -->
        <?php $this->endWidget(); ?>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php $errors =\Yii::app()->session['aReviews']['form']->getErrors(); ?>
<?php if( !empty($errors) ):{ ?>
    <script>
        $(document).ready(function() {
            $('#reviews-modal').modal('show');
        });
    </script>
<?php }endif; ?>