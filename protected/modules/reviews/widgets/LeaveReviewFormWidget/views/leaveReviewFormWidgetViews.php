<div class="row-fluid reviews-wrapper">

    <div class="row-fluid">
        <div class="span12">
            <h4>Оставить отзыв</h4>
        </div>
    </div>
    <?
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm', [
            'id'                     => 'reviews-form',
            'enableAjaxValidation'   => false,
            'enableClientValidation' => true,
            'clientOptions'=>[
                'validateOnSubmit'=>true,
            ],
            'type'                   => 'vertical',
            'htmlOptions'            => [
                'class' => 'reviews-form row-fluid',
                'enctype' => 'multipart/form-data'
            ],
            'inlineErrors'           => true,
        ]
    );
    ?>

    <div class="row-fluid">
        <div class="span6">
            <div class="row-fluid margin">
                <div class="span6">

                    <div class="row-fluid">
                        <div class="span12">
                            <?php echo $form->labelEx($model, 'name'); ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12 position-relative">
                            <?php echo $form->textField($model,'name',[
                                    'class' => 'span12 field',
                                    'placeholder' => 'Ф.И.О.',
                                ]
                            ); ?>
                            <?php echo $form->error($model,'name'); ?>
                        </div>
                    </div>

                </div>

                <div class="span6">

                    <div class="row-fluid">
                        <div class="span12">
                            <?php echo $form->labelEx($model, 'organisation'); ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12 position-relative">
                            <?php echo $form->textField($model,'organisation',[
                                    'class'=>'span12 field',
                                    'placeholder' => 'Ваша организация',
                                ]
                            ); ?>
                            <?php echo $form->error($model,'organisation'); ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row-fluid margin">
                <div class="span6 <?php echo $model->hasErrors('rating') ? 'error' : ''; ?>">
                    <div class="row-fluid">
                        <div class="span12">
                            <?php echo $form->labelEx($model, 'rating'); ?>
                        </div>
                    </div>

                    <div class="row-fluid position-relative">

                        <?php echo $form->dropDownList($model, 'rating', $model->getRatingList(), [
                                'encode' => false,
                                'empty' => '--Оценить--',
                                'class' => 'span12 popover-help field',
                            ]
                        ); ?>

                        <?php echo $form->error($model,'rating'); ?>

                    </div>
                </div>

                <div class="span6 control-group <?php echo $model->hasErrors('image') ? 'error' : ''; ?>">
                    <div class="span12  popover-help" data-original-title="<?php echo $model->getAttributeLabel('image'); ?>">
                        <?php
                        echo CHtml::image(
                            !$model->isNewRecord && $model->image
                                ? $model->getImageUrl()
                                : '#',
                            $model->name, [
                                'class' => 'preview-image',
                                'style' => !$model->isNewRecord && $model->image
                                        ? ''
                                        : 'display:none'
                            ]
                        ); ?>
                        <?php echo $form->labelEx($model, 'image'); ?>
                        <?php echo $form->fileField($model, 'image', [
                                'onchange' => 'readURL(this);',
                                'class' => 'span12 field',
                                'style' => 'line-height: 20px;',
                            ]
                        ); ?>
                    </div>
                </div>
            </div>

            <div class="row-fluid margin">
                <div class="span4">
                    <?php echo CHtml::submitButton('Отправить отзыв',[
                            'class'=>'btn btn-submit transition shadow animated'
                        ]
                    ); ?>
                </div>
            </div>
        </div>

        <div class="span6">

            <div class="row-fluid">
                <div class="span12">

                    <div class="row-fluid">
                        <div class="span12">
                            <?php echo $form->labelEx($model, 'message'); ?>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12 position-relative">
                            <?php echo $form->textArea($model,'message',[
                                    'class' => 'span12 field reviews-message',
                                    'placeholder' => 'Ваш отзыв',
                                ]
                            ); ?>
                            <?php echo $form->error($model,'message'); ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>