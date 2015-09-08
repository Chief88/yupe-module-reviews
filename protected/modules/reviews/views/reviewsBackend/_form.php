<?php

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'reviews-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>
<div class="alert alert-info">
    <?php echo Yii::t($aliasModule, 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t($aliasModule, 'are required'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row">

    <div class="col-xs-2 <?php echo $model->hasErrors('status') ? 'error' : ''; ?>">
        <?php echo $form->dropDownListGroup(
            $model,
            'status',
            [
                'widgetOptions' => [
                    'data' => $model->getStatusList(),
                ],
            ]
        ); ?>
    </div>

    <div class="col-xs-2 <?php echo $model->hasErrors('rating') ? 'error' : ''; ?>">
        <?php echo $form->dropDownListGroup(
            $model,
            'rating',
            [
                'widgetOptions' => [
                    'data' => $model->getRatingList(),
                    'htmlOptions' => [
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ],
                ],
            ]
        ); ?>
    </div>

    <div class="col-xs-3 <?php echo $model->hasErrors('on_home') ? 'error' : ''; ?>">
        <?php echo $form->checkBoxGroup(
            $model,
            'on_home',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('on_home'),
                        'data-content'        => $model->getAttributeDescription('on_home'),
                    ],
                ],
            ]
        ); ?>
    </div>

</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'organisation'); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'email'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php
        echo CHtml::image(
            !$model->isNewRecord && $model->image ? $model->getImageUrl() : '#',
            $model->name,
            [
                'class' => 'preview-image',
                'style' => !$model->isNewRecord && $model->image ? '' : 'display:none'
            ]
        );  ?>
		<?php if (!$model->isNewRecord && $model->image): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                </label>
            </div>
        <?php endif; ?>
        <?php echo $form->fileFieldGroup(
            $model,
            'image',
            [
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

<div class="row">
    
    <div class="col-xs-12 <?php echo $model->hasErrors('message') ? 'has-error' : ''; ?>">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php $this->widget(
            $this->module->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'message',
            ]
        ); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>
    
</div>

<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t($aliasModule, 'Create article and continue') : Yii::t(
            $aliasModule,
            'Save reviews article and continue'
        ),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ? Yii::t($aliasModule, 'Create article and close') : Yii::t(
            $aliasModule,
            'Save reviews article and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>
